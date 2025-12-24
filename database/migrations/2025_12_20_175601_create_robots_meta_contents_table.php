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
        Schema::create('robots_meta_contents', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('page_title', 191)->nullable();
            $table->string('page_name', 191)->nullable();
            $table->string('page_url', 191)->nullable();
            $table->string('meta_title', 191)->nullable();
            $table->text('meta_description')->nullable();
            $table->string('meta_image', 191)->nullable();
            $table->string('canonicals_url', 191)->nullable();
            $table->string('index', 191)->nullable();
            $table->string('no_follow', 191)->nullable();
            $table->string('no_image_index', 191)->nullable();
            $table->string('no_archive', 191)->nullable();
            $table->string('no_snippet', 191)->nullable();
            $table->string('max_snippet', 191)->nullable();
            $table->string('max_snippet_value', 191)->nullable();
            $table->string('max_video_preview', 191)->nullable();
            $table->string('max_video_preview_value', 191)->nullable();
            $table->string('max_image_preview', 191)->nullable();
            $table->string('max_image_preview_value', 191)->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('robots_meta_contents');
    }
};
