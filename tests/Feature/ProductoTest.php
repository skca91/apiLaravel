<?php

namespace Tests\Feature;

use App\Producto;
use App\User;
use Tests\TestCase;

class ProductoTest extends TestCase
{
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function testProductoListedSucessfully()
    {
        
        $user = User::factory()->create();
        $this->actingAs($user, 'api');

        Producto::factory()->create([
            "nombre" => "Susan Wojcicki",
            "descripcion" => "YouTube",
            "precio" => 1520,
            "inventario" => 2,
            "descuento" => 8,
        ]);

        Producto::factory()->create([
            "nombre" => "camisa",
            "descripcion" => "es una camisa",
            "precio" => 152785,
            "inventario" => 7,
            "descuento" => 10,
        ]);

        $this->json('GET', 'api/productos', ['Accept' => 'application/json'])
        ->assertStatus(200)
        ->assertJson([
            "data" => [
                [
                    "nombre" => "Susan Wojcicki",
                    'precioTotal' => round(((1 - (8/100)) * 1520), 2),
                    'clasificacion' => 'No tiene clasificacion',
                    'href' => [
                        'enlace' => 'http://localhost/api/productos/1'
                    ]
                ],
                [
                    "nombre" => "camisa",
                    'precioTotal' => round(((1 - (10/100)) * 152785), 2),
                    'clasificacion' => 'No tiene clasificacion',
                    'href' => [
                        'enlace' => 'http://localhost/api/productos/2'
                    ]
                ]
            ]
        ]);
    }

    public function testProductoStoreSucessfully() 
    {
        $user = User::factory()->create();
        $this->actingAs($user, 'api');

        $productoData = [
            "nombre" => "Susan Wojcicki",
            "descripcion" => "YouTube",
            "precio" => 1520,
            "inventario" => 2,
            "descuento" => 8,
        ];

        $this->json('POST', 'api/productos', $productoData, ['Accept' => 'application/json'])
        ->assertStatus(201)
        ->assertJson([
            "producto" => [
                
                "nombre" => "Susan Wojcicki",
                "descripcion" => "YouTube",
                "precio" => 1520,
                "inventario" => 2,
                "descuento" => 8,
                "precioTotal" => round(((1 - (8/100)) * 1520), 2),
                "clasificacion" => 'No tiene clasificacion',
                "href" => [
                    "resenias" => "http://localhost/api/productos/1/resenias"
                ]
                
            ]
        ]); 
    }
}
