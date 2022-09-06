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
        Schema::create('categories', function (Blueprint $table) {
            $table->id();
            $table->string('name_uz');
            $table->string('name_ru');
            $table->string('name_en');
            $table->timestamps();
        });

        DB::table('categories')->insert(
            [
                [
                    'name_uz' => 'Calligraphy',
                    'name_ru' => 'Calligraphy ru',
                    'name_en' => 'Calligraphy en',
                    'created_at' => now(),
                    'updated_at' => now(),
                ],
                [
                    'name_uz' => 'Painting',
                    'name_ru' => 'Painting ru',
                    'name_en' => 'Painting en',
                    'created_at' => now(),
                    'updated_at' => now(),
                ],
                [
                    'name_uz' => 'Sculpture',
                    'name_ru' => 'Sculpture ru',
                    'name_en' => 'Sculpture en',
                    'created_at' => now(),
                    'updated_at' => now(),
                ],
                [
                    'name_uz' => 'Photography',
                    'name_ru' => 'Photography ru',
                    'name_en' => 'Photography en',
                    'created_at' => now(),
                    'updated_at' => now(),
                ],
                [
                    'name_uz' => 'Ceramics',
                    'name_ru' => 'Ceramics ru',
                    'name_en' => 'Ceramics en',
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
        Schema::dropIfExists('categories');
    }
};
