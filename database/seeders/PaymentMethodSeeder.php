<?php

namespace Database\Seeders;

use App\Models\PaymentMethod;
use Illuminate\Database\Seeder;

class PaymentMethodSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $methods = [
            [
                'method' => __("Cash"),
            ],
            [
                'method' => __("PIX"),
            ],
            [
                'method' => __("Credit Card"),
            ],
            [
                'method' => __("Debit Card"),
            ],
        ];
        foreach ($methods as $method) {
            PaymentMethod::create($method);
        }
    }
}
