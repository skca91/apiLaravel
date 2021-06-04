<?php

namespace Database\Factories;

use App\Resenia;
use Illuminate\Database\Eloquent\Factories\Factory;

class ReseniaFactory extends Factory
{

    protected $model = Resenia::class;

    public function definition()  {
        return [
            'cliente' =>  $this->faker->name,
            'resenia' =>  $this->faker->paragraph,
            'estrella' =>  $this->faker->numberBetween(0,5),
            'producto_id' => 2
        ];
    }
}
