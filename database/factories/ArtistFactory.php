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
            'description_uz' => 'Uz description '.fake()->text(),
            'description_ru' => 'Ru description '.fake()->text(),
            'description_en' => 'En description '.fake()->text(),
            'views' => rand(0, 10000),
            'muzey_uz' => 'Uz muzey '.fake()->text(),
            'muzey_ru' => 'Ru muzey '.fake()->text(),
            'muzey_en' => 'En muzey '.fake()->text(),
            'medal_uz' => 'Uz medal '.fake()->text(),
            'medal_ru' => 'RU medal '.fake()->text(),
            'medal_en' => 'En medal '.fake()->text(),
            'label' => Str::random(10)
        ];
    }
}
