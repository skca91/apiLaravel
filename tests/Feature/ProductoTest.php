<?php

namespace Tests\Feature;

use App\Producto;
use App\User;
use App\Resenia;
use Tests\TestCase;

class ProductoTest extends TestCase
{
    protected $user;
    public function setUp():void {

        parent::setUp();
        $this->user = User::factory()->create();
        $this->actingAs($this->user, 'api');
    }

    public function test_producto_listed_sucessfully()
    {

        Producto::factory()->create([
            "nombre" => "Susan Wojcicki",
            "descripcion" => "YouTube",
            "precio" => 1000,
            "inventario" => 2,
            "descuento" => 8,
            "user_id" => $this->user->id
        ]);

        Producto::factory()->create([
            "nombre" => "camisa",
            "descripcion" => "es una camisa",
            "precio" => 100,
            "inventario" => 7,
            "descuento" => 10,
            "user_id" => $this->user->id
        ]);

        $this->json('GET', route("productos.index"), ['Accept' => 'application/json'])
        ->assertStatus(200)
        ->assertJson([
            "data" => [
                [
                    "nombre" => "Susan Wojcicki",
                    'precioTotal' => 920,
                    'clasificacion' => 'No tiene clasificacion',
                    'href' => [
                        'enlace' => route('productos.show', 1)
                    ]
                ],
                [
                    "nombre" => "camisa",
                    'precioTotal' => 90,
                    'clasificacion' => 'No tiene clasificacion',
                    'href' => [
                        'enlace' => route('productos.show', 2)
                    ]
                ]
            ]
        ]);
    }

    public function test_producto_store_sucessfully() 
    {
        
        $productoData = [
            "nombre" => "Susan Wojcicki",
            "descripcion" => "YouTube",
            "precio" => 100,
            "inventario" => 2,
            "descuento" => 8,
            "user_id" => $this->user->id
        ];

        $this->json('POST', route("productos.store"), $productoData, ['Accept' => 'application/json'])
        ->assertStatus(201)
        ->assertJson([
            'producto' => [
                'nombre' => $productoData['nombre'],
                'descripcion' => $productoData["descripcion"],
                'precio' => $productoData["precio"],
                'inventario' => 2,
                'descuento' => $productoData["descuento"],
                'precioTotal' => 92,
                'clasificacion' => 'No tiene clasificacion',
                // 'href' => [
                //     'resenias' => route('resenias.index', 1)
                // ]
            ]
        ]);
    }

    public function test_producto_showed_sucessfully() {

        $producto = Producto::factory()->create([
            "nombre" => "Susan Wojcicki",
            "descripcion" => "YouTube",
            "precio" => 1000,
            "inventario" => 2,
            "descuento" => 8,
        ]);


        $this->withoutExceptionHandling();
        $this->json("GET", route("productos.show", $producto->id))
        ->assertStatus(200);
    }

    public function test_producto_can_update(){


        $producto = Producto::factory()->create();

        $updateData = [
            "nombre" => "Susan Wojcicki",
            "descripcion" => "YouTube",
            "precio" => 100,
            "inventario" => 2,
            "descuento" => 8,
            "user_id" => $this->user->id
        ]; 
        
        $this->json("PUT", route("productos.update", $producto->id), $updateData)
        ->assertStatus(200);

    }

    public function test_producto_can_delete(){

        $producto = Producto::factory()->create();

        $this->delete(route("productos.destroy", $producto->id))
        ->assertStatus(200);
    }

}
