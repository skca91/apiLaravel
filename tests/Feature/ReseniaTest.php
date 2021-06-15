<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use App\Producto;
use App\Resenia;
use App\User;

use Tests\TestCase;

class ReseniaTest extends TestCase
{
    
    protected $user;
    public function setUp():void {

        parent::setUp();
        $this->user = User::factory()->create();
        $this->actingAs($this->user, 'api');
    }

    public function test_resenia_listed_sucessfully()
    {
        $producto = Producto::factory()->create([
            'nombre' => 'Shampoo',
            'descripcion' => 'NUevo shampoo',
            'precio' => 100,
            'inventario' => 12,
            'descuento' => 5,
            'user_id' => $this->user->id
        ]);

        //dd( $producto->id);

        $resenia = Resenia::factory()->create([
            
            "cliente" =>  "Maria",
            "resenia" =>  "buen producto",
            "estrella" =>  4,
            "producto_id" => $producto->id,
        ]);

        $producto->resenia()->save($resenia);

        $this->withoutExceptionHandling();
        $this->json("GET", route("resenias.index", $producto->id))
        ->assertStatus(200);
    }

    public function test_resenia_stored_sucessfully(){

        $producto = Producto::factory()->create([
                    'nombre' => 'Shampoo',
                    'descripcion' => 'NUevo shampoo',
                    'precio' => 100,
                    'inventario' => 12,
                    'descuento' => 5,
                    'user_id' => $this->user->id
                ]);

        $resenia = [
            'cliente' =>  "Maria",
            'resenia' =>  "buen producto",
            'estrella' =>  4,
            'producto_id' => $producto->id,
        ];

        //$producto->resenia()->save($resenia);
        $this->withoutExceptionHandling();
        $this->json('POST', route("resenias.store", $producto->id), $resenia)
        ->assertStatus(201);

    }

    public function test_resenia_updated_sucessfully(){

        $producto = Producto::factory()->create([
            'nombre' => 'Shampoo',
            'descripcion' => 'NUevo shampoo',
            'precio' => 100,
            'inventario' => 12,
            'descuento' => 5,
            'user_id' => $this->user->id
        ]);

        $resenia = Resenia::factory()->create([
            
            "cliente" =>  "Maria",
            "resenia" =>  "buen producto",
            "estrella" =>  4,
            "producto_id" => $producto->id,
        ]);

        $reseniaUpdate = [
            'resenia' =>  "buen producto, demasido bueno",
            'estrella' =>  5,
        ];

        $this->json("PUT", route("resenias.update", $resenia->id), $reseniaUpdate)
        ->assertStatus(200);

    }

}
