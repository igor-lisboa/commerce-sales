<?php

namespace Database\Factories;

use App\Models\Product;
use Illuminate\Database\Eloquent\Factories\Factory;

class ProductFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Product::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $promotion_price = $this->faker->randomNumber() / 100;
        $price = $this->faker->randomNumber() / 100;
        return [
            'name' => $this->faker->word,
            'bar_code' => strval($this->faker->isbn13),
            'provider' => $this->faker->company(),
            'price_cents' => $price,
            'price_cents_promotion' => ($promotion_price < $price ? $promotion_price  : null),
        ];
    }
}
