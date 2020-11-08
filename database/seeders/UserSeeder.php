<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::insert([
            [
                "name" => "Igor Lisboa",
                "email" => "igor_lisboa@id.uff.br",
                "password" => Hash::make("123")
            ],
            [
                "name" => "Caio Wey",
                "email" => "caiowey@id.uff.br",
                "password" => Hash::make("321")
            ]
        ]);
    }
}
