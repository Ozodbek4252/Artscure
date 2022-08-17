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
            $table->string('first_name_en');
            $table->string('last_name_uz');
            $table->string('last_name_ru');
            $table->string('last_name_en');
            $table->string('speciality');
            $table->string('rate', 0, 5)->nullable();
            $table->foreignId('category_id')->nullable()->constrained('categories')->references('id')->onDelete('set null');
            $table->text('description_uz');
            $table->text('description_ru');
            $table->text('description_en');
            $table->integer('views')->default(0);
            $table->string('muzey_uz')->nullable();
            $table->string('muzey_ru')->nullable();
            $table->string('muzey_en')->nullable();
            $table->string('medal_uz')->nullable();
            $table->string('medal_ru')->nullable();
            $table->string('medal_en')->nullable();
            $table->string('label')->nullable();
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
