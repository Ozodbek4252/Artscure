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
            $table->string('slug')->index();
            $table->string('sku')->unique()->nullable();
            $table->string('name_uz');
            $table->string('name_ru');
            $table->string('name_en')->nullable();
            $table->boolean('certificate')->default(false);
            $table->boolean('frame')->default(false);
            $table->string('size')->nullable();
            $table->text('description_uz');
            $table->text('description_ru');
            $table->text('description_en')->nullable();
            $table->integer('views')->default(0);
            $table->integer('type_id')->nullable();
            $table->integer('artist_id')->nullable();
            $table->string('status')->default('0');
            $table->string('year')->nullable();
            $table->string('city')->nullable();
            $table->boolean('unique')->default(false);
            $table->boolean('signiture')->default(false);
            $table->integer('price')->nullable();
            $table->boolean('is_sold')->default(false);

            $table->jsonb('resell')->nullable();
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
