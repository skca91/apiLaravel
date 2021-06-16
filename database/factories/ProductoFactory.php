<?php

namespace Database\Factories;

use App\Models\Producto;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class ProductoFactory extends Factory
{

    protected $model = Producto::class;

    public function definition() {
        return [
            'nombre' => $this->faker->word,
            'descripcion' => $this->faker->paragraph,
            'precio' => $this->faker->numberBetween(100,10000),
            'inventario' => $this->faker->randomDigit,
            'descuento' => $this->faker->numberBetween(5,25),
            'user_id' => User::inRandomOrder()->value('id')
        ];
    }

}

