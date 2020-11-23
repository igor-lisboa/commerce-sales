<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        \App\Models\User::factory(15)->create();
        \App\Models\Product::factory(50)->create();
        \App\Models\Client::factory(25)->create();
        $this->call([
            UserSeeder::class,
            ManagerSeeder::class,
            ProductStockSeeder::class
        ]);
    }
}
