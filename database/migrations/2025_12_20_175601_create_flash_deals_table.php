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
        Schema::create('flash_deals', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('title', 150)->nullable();
            $table->date('start_date')->nullable();
            $table->date('end_date')->nullable();
            $table->boolean('status')->default(false);
            $table->boolean('featured')->default(false);
            $table->string('background_color', 191)->nullable();
            $table->string('text_color', 191)->nullable();
            $table->string('banner', 100)->nullable();
            $table->string('slug', 191)->nullable();
            $table->timestamps();
            $table->integer('product_id')->nullable();
            $table->string('deal_type')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('flash_deals');
    }
};
