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
        Schema::create('search_functions', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('key', 150)->nullable();
            $table->string('url', 250)->nullable();
            $table->string('visible_for')->default('admin');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('search_functions');
    }
};
