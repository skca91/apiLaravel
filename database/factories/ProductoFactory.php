<?php

use Faker\Generator as Faker;

$factory->define(App\Producto::class, function (Faker $faker) {
    return [
        'nombre' => $faker->word,
        'descripcion' => $faker->paragraph,
        'precio' => $faker->numberBetween(100,10000),
        'inventario' => $faker->randomDigit,
        'descuento' => $faker->numberBetween(5,25),
    ];
});

