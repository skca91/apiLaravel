<?php

use App\Producto;
use Illuminate\Database\Seeder;
use App\User;
use App\Resenia;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // $this->call(UsersTableSeeder::class);
        User::factory()->count(10)->create();
        Producto::factory()->count(50)->create();
        Resenia::factory()->count(200)->create();
    }
}
