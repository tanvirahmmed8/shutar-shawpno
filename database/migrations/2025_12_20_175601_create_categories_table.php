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
        Schema::create('categories', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('name', 100);
            $table->string('slug', 100);
            $table->string('icon', 250)->nullable();
            $table->string('icon_storage_type', 10)->nullable()->default('public');
            $table->integer('parent_id');
            $table->integer('position');
            $table->timestamps();
            $table->boolean('home_status')->default(false);
            $table->integer('priority')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('categories');
    }
};
