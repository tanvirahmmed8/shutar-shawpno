<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('banners', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('photo', 191)->nullable();
            $table->string('banner_type', 191);
            $table->string('theme', 191)->default('default');
            $table->integer('published')->default(0);
            $table->timestamps();
            $table->string('url', 191)->nullable();
            $table->string('resource_type')->nullable();
            $table->bigInteger('resource_id')->nullable();
            $table->string('title')->nullable();
            $table->string('sub_title')->nullable();
            $table->string('button_text')->nullable();
            $table->string('background_color')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('banners');
    }
};
