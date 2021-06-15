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
        $producto = Producto::factory()->create();

        $resenia = Resenia::factory()->create([
            'cliente' =>  "Maria",
            'resenia' =>  "buen producto",
            'estrella' =>  4,
            'producto_id' => $producto->id
        ]);

        $producto->resenia()->save($resenia);
       
        $this->json("GET", route("resenias.index", $producto->id))
        ->assertStatus(200);
    }

    public function test_resenia_stored_sucessfully(){

        $producto = Producto::factory()->create();

        $resenia = [
            'cliente' =>  "Maria",
            'resenia' =>  "buen producto",
            'estrella' =>  4,
            'producto_id' => $producto->id
        ];

        //$producto->resenia()->associate($resenia);
        $this->withoutExceptionHandling();
        $this->json('POST', route("resenias.store", $producto->id), $resenia)
        ->assertStatus(201);


    }
}
