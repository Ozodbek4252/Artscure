<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Seeder;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Category::create([
            'slug' => 'calligraphy-12345',
            'name_uz' => 'Calligraphy',
            'name_ru' => 'Calligraphy ru',
            'name_en' => 'Calligraphy en',
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        Category::create([
            'slug' => 'sculpture-12345',
            'name_uz' => 'Sculpture',
            'name_ru' => 'Sculpture ru',
            'name_en' => 'Sculpture en',
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        Category::create([
            'slug' => 'ceramics-12345',
            'name_uz' => 'Ceramics',
            'name_ru' => 'Ceramics ru',
            'name_en' => 'Ceramics en',
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        Category::create([
            'slug' => 'photography-12345',
            'name_uz' => 'Photography',
            'name_ru' => 'Photography ru',
            'name_en' => 'Photography en',
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        Category::create([
            'slug' => 'painting-12345',
            'name_uz' => 'Painting',
            'name_ru' => 'Painting ru',
            'name_en' => 'Painting en',
            'created_at' => now(),
            'updated_at' => now(),
        ]);
    }
}
