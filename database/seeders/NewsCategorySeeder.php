<?php

namespace Database\Seeders;

use App\Models\NewsCategory;
use Illuminate\Database\Seeder;

class NewsCategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        NewsCategory::create([
            'name_uz' => 'Art uz',
            'name_ru' => 'Art ru',
            'name_en' => 'Art en',
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        NewsCategory::create([
            'name_uz' => 'Ceramic uz',
            'name_ru' => 'Ceramic ru',
            'name_en' => 'Ceramic en',
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        NewsCategory::create([
            'name_uz' => 'Calligraphy uz',
            'name_ru' => 'Calligraphy ru',
            'name_en' => 'Calligraphy en',
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        NewsCategory::create([
            'name_uz' => 'Sculpture uz',
            'name_ru' => 'Sculpture ru',
            'name_en' => 'Sculpture en',
            'created_at' => now(),
            'updated_at' => now(),
        ]);
    }
}
