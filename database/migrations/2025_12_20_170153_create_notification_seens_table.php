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
        Schema::create('notification_seens', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('seller_id')->nullable();
            $table->integer('user_id')->nullable();
            $table->integer('notification_id');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('notification_seens');
    }
};
