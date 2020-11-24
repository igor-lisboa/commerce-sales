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
                'can_have_change' => true
            ],
            [
                'method' => __("PIX"),
                'can_have_change' => false
            ],
            [
                'method' => __("Credit Card"),
                'can_have_change' => false
            ],
            [
                'method' => __("Debit Card"),
                'can_have_change' => false
            ],
        ];
        foreach ($methods as $method) {
            PaymentMethod::create($method);
        }
    }
}
