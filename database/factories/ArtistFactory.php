<?php

namespace Database\Factories;

use App\Models\Artist;
use App\Models\Category;
use App\Models\Type;
use Illuminate\Database\Eloquent\Factories\Factory;

use Illuminate\Support\Str;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Artist>
 */
class ArtistFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        $l_name = fake()->name();
        $f_name = fake()->name();
        return [
            'slug' => Str::random(10),
            'first_name_uz' => $f_name.' uz',
            'first_name_ru' => $f_name.' ru',
            'first_name_en' => $f_name.' en',
            'last_name_uz' => $l_name.' uz',
            'last_name_ru' => $l_name.' ru',
            'last_name_en' => $l_name.' en',
            'speciality' => Str::random(8),
            'rate' => rand(0, 5),
            'category_id' => Category::inRandomOrder()->first()->id,
            'description_uz' => fake()->text(),
            'description_ru' => fake()->text(),
            'description_en' => fake()->text(),
            'views' => rand(0, 10000),
            'muzey_uz' => fake()->text(),
            'muzey_ru' => fake()->text(),
            'muzey_en' => fake()->text(),
            'medal_ru' => fake()->text(),
            'medal_ru' => fake()->text(),
            'medal_en' => fake()->text(),
            'label' => Str::random(10)
        ];
    }
}
