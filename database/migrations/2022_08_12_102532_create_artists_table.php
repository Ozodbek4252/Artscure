<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
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
        Schema::create('artists', function (Blueprint $table) {
            $table->id();

            $table->string('slug');

            $table->string('first_name_uz');
            $table->string('first_name_ru');
            $table->string('first_name_en')->nullable();
            $table->string('last_name_uz')->nullable();
            $table->string('last_name_ru')->nullable();
            $table->string('last_name_en')->nullable();

            $table->string('speciality')->nullable();
            $table->integer('rate')->nullable();
            $table->integer('category_id')->nullable();
            $table->text('label')->nullable();
            $table->integer('views')->default(0);

            $table->text('description_uz')->nullable();
            $table->text('description_ru')->nullable();
            $table->text('description_en')->nullable();
            $table->text('muzey_uz')->nullable();
            $table->text('muzey_ru')->nullable();
            $table->text('muzey_en')->nullable();
            $table->text('medal_uz')->nullable();
            $table->text('medal_ru')->nullable();
            $table->text('medal_en')->nullable();

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('artists');
    }
};
