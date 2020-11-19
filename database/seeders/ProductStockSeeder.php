<?php

namespace Database\Seeders;

use App\Models\Product;
use App\Models\ProductStock;
use Illuminate\Database\Seeder;

class ProductStockSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $products = Product::get();
        foreach ($products as $product) {
            ProductStock::create(['product_id' => $product->id, 'input' => random_int(1, 10000)]);
        }
    }
}
