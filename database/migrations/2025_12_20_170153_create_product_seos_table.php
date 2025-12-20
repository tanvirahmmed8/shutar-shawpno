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
        Schema::create('product_seos', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('product_id');
            $table->string('title', 255)->nullable();
            $table->string('description', 255)->nullable();
            $table->string('index', 255)->nullable();
            $table->string('no_follow', 255)->nullable();
            $table->string('no_image_index', 255)->nullable();
            $table->string('no_archive', 255)->nullable();
            $table->string('no_snippet', 255)->nullable();
            $table->string('max_snippet', 255)->nullable();
            $table->string('max_snippet_value', 255)->nullable();
            $table->string('max_video_preview', 255)->nullable();
            $table->string('max_video_preview_value', 255)->nullable();
            $table->string('max_image_preview', 255)->nullable();
            $table->string('max_image_preview_value', 255)->nullable();
            $table->string('image', 255)->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('product_seos');
    }
};
