<?php

namespace Database\Factories;

use App\Models\Client;
use Illuminate\Database\Eloquent\Factories\Factory;

class ClientFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Client::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'preferential' => $this->faker->boolean(),
            'name' => $this->faker->name,
            'email' => $this->faker->unique()->safeEmail,
            'cpf' => $this->faker->unique()->randomNumber(),
            'identity' => $this->faker->unique()->randomNumber(),
            'address' => $this->faker->streetAddress  . ', ' . $this->faker->city . '-' . $this->faker->state . ' | ' . $this->faker->postcode,
        ];
    }
}
