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
        Schema::create('banners', function (Blueprint $table) {
            $table->id();
            $table->tinyInteger('type')->comment('0 - top, 1 - bottom, 2 - others');
            $table->string('title_uz');
            $table->string('title_ru');
            $table->string('title_en');
            $table->text('body_uz');
            $table->text('body_ru');
            $table->text('body_en');
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
        Schema::dropIfExists('banners');
    }
};
