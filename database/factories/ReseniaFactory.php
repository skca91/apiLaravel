<?php

use Faker\Generator as Faker;
use App\Producto;

$factory->define(App\Resenia::class, function (Faker $faker) {
    return [
        'cliente' => $faker->name,
        'resenia' => $faker->paragraph,
        'estrella' => $faker->numberBetween(0,5),
        'producto_id' => function(){

        	return Producto::all()->random();
        }
    ];
});
