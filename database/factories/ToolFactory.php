<?php

namespace Database\Factories;

use App\Models\Type;
use Illuminate\Database\Eloquent\Factories\Factory;

use Illuminate\Support\Str;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Tool>
 */
class ToolFactory extends Factory
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
            'name_uz' => $name.' uz',
            'name_ru' => $name.' ru',
            'name_en' => $name.' en',
            'type_id' => Type::inRandomOrder()->first()->id
        ];
    }
}
