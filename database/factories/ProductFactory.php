<?php

namespace Database\Factories;

use App\Models\Artist;
use App\Models\Type;
use Illuminate\Database\Eloquent\Factories\Factory;

use Illuminate\Support\Str;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Product>
 */
class ProductFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        $name = Str::random(5);
        return [
            'slug' => Str::random(10),
            'sku' => rand(1000, 9999).Str::random(4),
            'name_uz' => $name.' uz',
            'name_ru' => $name.' ru',
            'name_en' => $name.' en',
            'certificate'  => array_rand([true, false]),
            'frame' => array_rand([true, false]),
            'size' => rand(10, 500).'x'.rand(10, 500),
            'description_uz' => fake()->text(),
            'description_ru' => fake()->text(),
            'description_en' => fake()->text(),
            'year' => fake()->date('Y'),
            'city' => fake()->city(),
            'views' => rand(0, 10000),
            'unique' => array_rand([true, false]),
            'signiture' => array_rand([true, false]),
            'price' => rand(100, 10000),
            'type_id' => Type::inRandomOrder()->first()->id,
            'artist_id' => Artist::inRandomOrder()->first()->id,
            'status' => 'true',
        ];
    }
}
