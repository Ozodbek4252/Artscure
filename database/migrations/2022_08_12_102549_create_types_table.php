<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('types', function (Blueprint $table) {
            $table->id();
            $table->string('slug');
            $table->string('name_uz');
            $table->string('name_ru');
            $table->string('name_en');
            $table->integer('views')->default(0);
            $table->foreignId('category_id')->constrained("categories")->references("id")->onDelete("cascade");
            $table->timestamps();
        });

        DB::table('types')->insert(
            [
                [
                    'slug' => 'modernism-Vo9kq',
                    'name_uz' => 'Modernism',
                    'name_ru' => 'Modernism ru',
                    'name_en' => 'Modernism en',
                    'views' => 0,
                    'category_id' => 2,
                    'created_at' => now(),
                    'updated_at' => now(),
                ],
                [
                    'slug' => 'impressionism-OcgMl',
                    'name_uz' => 'Impressionism',
                    'name_ru' => 'Impressionism ru',
                    'name_en' => 'Impressionism en',
                    'views' => 0,
                    'category_id' => 2,
                    'created_at' => now(),
                    'updated_at' => now(),
                ],
                [
                    'slug' => 'abstract_art-65',
                    'name_uz' => 'Abstract Art',
                    'name_ru' => 'Abstract Art ru',
                    'name_en' => 'Abstract Art en',
                    'views' => 0,
                    'category_id' => 2,
                    'created_at' => now(),
                    'updated_at' => now(),
                ],
                [
                    'slug' => 'expressionism-TWkGk',
                    'name_uz' => 'Expressionism',
                    'name_ru' => 'Expressionism ru',
                    'name_en' => 'Expressionism en',
                    'views' => 0,
                    'category_id' => 2,
                    'created_at' => now(),
                    'updated_at' => now(),
                ],
                [
                    'slug' => 'cubism-PdRrE',
                    'name_uz' => 'Cubism',
                    'name_ru' => 'Cubism ru',
                    'name_en' => 'Cubism en',
                    'views' => 0,
                    'category_id' => 2,
                    'created_at' => now(),
                    'updated_at' => now(),
                ],
                [
                    'slug' => 'surrealism-rGpRz',
                    'name_uz' => 'Surrealism',
                    'name_ru' => 'Surrealism ru',
                    'name_en' => 'Surrealism en',
                    'views' => 0,
                    'category_id' => 2,
                    'created_at' => now(),
                    'updated_at' => now(),
                ],
                [
                    'slug' => 'chinese_style-x75nS',
                    'name_uz' => 'Chinese Style',
                    'name_ru' => 'Chinese Style ru',
                    'name_en' => 'Chinese Style en',
                    'views' => 0,
                    'category_id' => 2,
                    'created_at' => now(),
                    'updated_at' => now(),
                ],
                [
                    'slug' => 'japanese_style-CrIcE',
                    'name_uz' => 'Japanese style',
                    'name_ru' => 'Japanese style ru',
                    'name_en' => 'Japanese style en',
                    'views' => 0,
                    'category_id' => 2,
                    'created_at' => now(),
                    'updated_at' => now(),
                ],
                [
                    'slug' => 'the_indian_style-7SC0u',
                    'name_uz' => 'The Indian style',
                    'name_ru' => 'The Indian style ru',
                    'name_en' => 'The Indian style en',
                    'views' => 0,
                    'category_id' => 2,
                    'created_at' => now(),
                    'updated_at' => now(),
                ],
                [
                    'slug' => 'relief_sculpture-BqzrL',
                    'name_uz' => 'Relief Sculpture',
                    'name_ru' => 'Relief Sculpture ru',
                    'name_en' => 'Relief Sculpture en',
                    'views' => 0,
                    'category_id' => 3,
                    'created_at' => now(),
                    'updated_at' => now(),
                ],
                [
                    'slug' => 'sculpture_in_the_round-TIofZ',
                    'name_uz' => 'Sculpture in the Round',
                    'name_ru' => 'Sculpture in the Round ru',
                    'name_en' => 'Sculpture in the Round en',
                    'views' => 0,
                    'category_id' => 3,
                    'created_at' => now(),
                    'updated_at' => now(),
                ],
                [
                    'slug' => 'carved_sculptures-XBznE',
                    'name_uz' => 'Carved Sculptures',
                    'name_ru' => 'Carved Sculptures ru',
                    'name_en' => 'Carved Sculptures en',
                    'views' => 0,
                    'category_id' => 3,
                    'created_at' => now(),
                    'updated_at' => now(),
                ],
                [
                    'slug' => 'cast_sculptures-SG5R9',
                    'name_uz' => 'Cast Sculptures',
                    'name_ru' => 'Cast Sculptures ru',
                    'name_en' => 'Cast Sculptures en',
                    'views' => 0,
                    'category_id' => 3,
                    'created_at' => now(),
                    'updated_at' => now(),
                ],
                [
                    'slug' => 'additive_sculpture-vlpka',
                    'name_uz' => 'Additive Sculpture',
                    'name_ru' => 'Additive Sculpture ru',
                    'name_en' => 'Additive Sculpture en',
                    'views' => 0,
                    'category_id' => 3,
                    'created_at' => now(),
                    'updated_at' => now(),
                ],
                [
                    'slug' => 'subtraction_sculpture-Egc8T',
                    'name_uz' => 'Subtraction Sculpture',
                    'name_ru' => 'Subtraction Sculpture ru',
                    'name_en' => 'Subtraction Sculpture en',
                    'views' => 0,
                    'category_id' => 3,
                    'created_at' => now(),
                    'updated_at' => now(),
                ],
                [
                    'slug' => 'assembled_sculptures-nv4bJ',
                    'name_uz' => 'Assembled Sculptures',
                    'name_ru' => 'Assembled Sculptures ru',
                    'name_en' => 'Assembled Sculptures en',
                    'views' => 0,
                    'category_id' => 3,
                    'created_at' => now(),
                    'updated_at' => now(),
                ],
                [
                    'slug' => 'modeled_sculptures-iTTtC',
                    'name_uz' => 'Modeled Sculptures',
                    'name_ru' => 'Modeled Sculptures ru',
                    'name_en' => 'Modeled Sculptures en',
                    'views' => 0,
                    'category_id' => 3,
                    'created_at' => now(),
                    'updated_at' => now(),
                ],
                [
                    'slug' => 'installation_sculptures-nFcTF',
                    'name_uz' => 'Installation Sculptures',
                    'name_ru' => 'Installation Sculptures ru',
                    'name_en' => 'Installation Sculptures en',
                    'views' => 0,
                    'category_id' => 3,
                    'created_at' => now(),
                    'updated_at' => now(),
                ],
                [
                    'slug' => 'kinetic_sculptures-Acatm',
                    'name_uz' => 'Kinetic Sculptures',
                    'name_ru' => 'Kinetic Sculptures ru',
                    'name_en' => 'Kinetic Sculptures en',
                    'views' => 0,
                    'category_id' => 3,
                    'created_at' => now(),
                    'updated_at' => now(),
                ],
                [
                    'slug' => 'earthwork_sculptures-Dh6mf',
                    'name_uz' => 'Earthwork Sculptures',
                    'name_ru' => 'Earthwork Sculptures ru',
                    'name_en' => 'Earthwork Sculptures en',
                    'views' => 0,
                    'category_id' => 3,
                    'created_at' => now(),
                    'updated_at' => now(),
                ],
                [
                    'slug' => 'silicate_ceramics-3ye0U',
                    'name_uz' => 'Silicate ceramics',
                    'name_ru' => 'Silicate ceramics ru',
                    'name_en' => 'Silicate ceramics en',
                    'views' => 0,
                    'category_id' => 7,
                    'created_at' => now(),
                    'updated_at' => now(),
                ],
                [
                    'slug' => 'oxide_ceramics-8V0vI',
                    'name_uz' => 'Oxide ceramics',
                    'name_ru' => 'Oxide ceramics ru',
                    'name_en' => 'Oxide ceramics en',
                    'views' => 0,
                    'category_id' => 7,
                    'created_at' => now(),
                    'updated_at' => now(),
                ],
                [
                    'slug' => 'non-oxide_ceramics-bDtfa',
                    'name_uz' => 'Non-Oxide ceramics',
                    'name_ru' => 'Non-Oxide ceramics ru',
                    'name_en' => 'Non-Oxide ceramics en',
                    'views' => 0,
                    'category_id' => 7,
                    'created_at' => now(),
                    'updated_at' => now(),
                ],
                [
                    'slug' => 'glass-ceramics-VVSZU',
                    'name_uz' => 'Glass-ceramics',
                    'name_ru' => 'Glass-ceramics ru',
                    'name_en' => 'Glass-ceramics en',
                    'views' => 0,
                    'category_id' => 7,
                    'created_at' => now(),
                    'updated_at' => now(),
                ],
                [
                    'slug' => 'western_calligraphy-mbCeJ',
                    'name_uz' => 'Western Calligraphy',
                    'name_ru' => 'Western Calligraphy ru',
                    'name_en' => 'Western Calligraphy en',
                    'views' => 0,
                    'category_id' => 5,
                    'created_at' => now(),
                    'updated_at' => now(),
                ],
                [
                    'slug' => 'eastern_asian_calligraphy-rmOg5',
                    'name_uz' => 'Eastern Asian Calligraphy',
                    'name_ru' => 'Eastern Asian Calligraphy ru',
                    'name_en' => 'Eastern Asian Calligraphy en',
                    'views' => 0,
                    'category_id' => 5,
                    'created_at' => now(),
                    'updated_at' => now(),
                ],
                [
                    'slug' => 'southern_asian_calligraphy-yxBvQ',
                    'name_uz' => 'Southern Asian Calligraphy',
                    'name_ru' => 'Southern Asian Calligraphy ru',
                    'name_en' => 'Southern Asian Calligraphy en',
                    'views' => 0,
                    'category_id' => 5,
                    'created_at' => now(),
                    'updated_at' => now(),
                ],
                [
                    'slug' => 'islamic_calligraphy-oAiNn',
                    'name_uz' => 'Islamic Calligraphy',
                    'name_ru' => 'Islamic Calligraphy ru',
                    'name_en' => 'Islamic Calligraphy en',
                    'views' => 0,
                    'category_id' => 5,
                    'created_at' => now(),
                    'updated_at' => now(),
                ],
                [
                    'slug' => 'portrait_photography-14lZE',
                    'name_uz' => 'Portrait Photography',
                    'name_ru' => 'Portrait Photography ru',
                    'name_en' => 'Portrait Photography en',
                    'views' => 0,
                    'category_id' => 6,
                    'created_at' => now(),
                    'updated_at' => now(),
                ],
                [
                    'slug' => 'photojournalism-7y2tU',
                    'name_uz' => 'Photojournalism',
                    'name_ru' => 'Photojournalism ru',
                    'name_en' => 'Photojournalism en',
                    'views' => 0,
                    'category_id' => 6,
                    'created_at' => now(),
                    'updated_at' => now(),
                ],
                [
                    'slug' => 'fashion_photography-xpfWR',
                    'name_uz' => 'Fashion Photography',
                    'name_ru' => 'Fashion Photography ru',
                    'name_en' => 'Fashion Photography en',
                    'views' => 0,
                    'category_id' => 6,
                    'created_at' => now(),
                    'updated_at' => now(),
                ],
                [
                    'slug' => 'sports_photography-wjTsO',
                    'name_uz' => 'Sports Photography',
                    'name_ru' => 'Sports Photography ru',
                    'name_en' => 'Sports Photography en',
                    'views' => 0,
                    'category_id' => 6,
                    'created_at' => now(),
                    'updated_at' => now(),
                ],
                [
                    'slug' => 'still_life_photography-rdn0d',
                    'name_uz' => 'Still Life Photography',
                    'name_ru' => 'Still Life Photography ru',
                    'name_en' => 'Still Life Photography en',
                    'views' => 0,
                    'category_id' => 6,
                    'created_at' => now(),
                    'updated_at' => now(),
                ],
                [
                    'slug' => 'editorial_photography-OI4QI',
                    'name_uz' => 'Editorial Photography',
                    'name_ru' => 'Editorial Photography ru',
                    'name_en' => 'Editorial Photography en',
                    'views' => 0,
                    'category_id' => 6,
                    'created_at' => now(),
                    'updated_at' => now(),
                ],
                [
                    'slug' => 'architectural_photography-dxI83',
                    'name_uz' => 'Architectural Photography',
                    'name_ru' => 'Architectural Photography ru',
                    'name_en' => 'Architectural Photography en',
                    'views' => 0,
                    'category_id' => 6,
                    'created_at' => now(),
                    'updated_at' => now(),
                ],
            ]
        );
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('types');
    }
};
