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
        Schema::create('storages', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('data_type', 191);
            $table->string('data_id', 100)->index();
            $table->string('key', 191)->nullable();
            $table->string('value', 191)->index();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('storages');
    }
};
