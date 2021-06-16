<?php

namespace Database\Factories;

use App\Models\Resenia;
use App\Models\Producto;
use Illuminate\Database\Eloquent\Factories\Factory;

class ReseniaFactory extends Factory
{

    protected $model = Resenia::class;

    public function definition()  {
        return [
            'cliente' =>  $this->faker->name,
            'resenia' =>  $this->faker->paragraph,
            'estrella' =>  $this->faker->numberBetween(0,5),
            'producto_id' => Producto::inRandomOrder()->value('id')
        ];
    }
}
