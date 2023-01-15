<?php

namespace Database\Factories;

use App\Models\Artist;
use App\Models\Product;
use App\Models\Tool;
use App\Models\Type;
use Illuminate\Database\Eloquent\Factories\Factory;

use Illuminate\Support\Str;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Tool>
 */
class ToolableFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        $toolable_type = array_rand(['Artist', 'Product']);
        if ($toolable_type == 0) {
            $toolable_type = 'Artist';
            $toolable_id = Artist::inRandomOrder()->first()->id;
        } elseif ($toolable_type == 1) {
            $toolable_type = 'Product';
            $toolable_id = Product::inRandomOrder()->first()->id;
        }

        return [
            'tool_id' => Tool::inRandomOrder()->first()->id,
            'toolable_id' => $toolable_id,
            'toolable_type' => 'App\Models\\'.$toolable_type,
        ];
    }
}
