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
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->string('slug');
            $table->string('name_uz');
            $table->string('name_ru');
            $table->string('name_en');
            $table->integer('certificate')->default('0');
            $table->integer('frame')->default('0');
            $table->string('size')->nullable();
            $table->text('description_uz');
            $table->text('description_ru');
            $table->text('description_en');
            $table->integer('views')->default('0');
            $table->integer('type_id')->nullable();
            $table->integer('artist_id');
            $table->integer('status')->default('0');
            $table->string('year')->nullable();
            $table->string('city')->nullable();
            $table->integer('unique')->default('0');
            $table->integer('signiture')->default('0');
            $table->integer('price')->nullable();
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
        Schema::dropIfExists('products');
    }
};
