<?php

namespace Database\Seeders;

use App\Models\PaymentType;
use Illuminate\Database\Seeder;

class PaymentTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        PaymentType::insert([
            [
                "type" => "Espécie"
            ],
            [
                "type" => "PIX"
            ],
            [
                "type" => "Cartão de Crédito"
            ],
            [
                "type" => "Cartão de Débito"
            ]
        ]);
    }
}
