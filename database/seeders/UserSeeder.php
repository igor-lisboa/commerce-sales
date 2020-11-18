<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;


class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $users = [
            [
                'name' => 'ADM2',
                'email' => 'igor@uff.com',
                'password' => Hash::make('123'),
                'remember_token' => Str::random(10),
            ],
            [
                'name' => 'ADM',
                'email' => 'caio@uff.com',
                'password' => Hash::make('123'),
                'remember_token' => Str::random(10),
            ]
        ];
        foreach ($users as $user) {
            User::create($user);
        }
    }
}
