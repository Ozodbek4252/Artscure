<?php

namespace Database\Factories;

use App\Models\Product;
use Illuminate\Database\Eloquent\Factories\Factory;

use Illuminate\Support\Str;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Order>
 */
class OrderFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'slug' => Str::random(10),
            'name' => fake()->name(),
            'phone' => fake()->phoneNumber(),
            'payment_type' => array_rand(['Click', 'Payme', 'Naqd', 'Visa', 'Apelsin']),
            'address' => fake()->address(),
            'total_price' => fake()->randomNumber(5),
        ];
    }
}
