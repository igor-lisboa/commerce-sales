<?php

namespace Database\Seeders;

use App\Models\Manager;
use App\Models\User;
use Illuminate\Database\Seeder;

class ManagerSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $managerUsers = User::whereIn('name', ['ADM', 'ADM2'])->get();
        foreach ($managerUsers as $managerUser) {
            Manager::create(['user_id' => $managerUser->id]);
        }
    }
}
