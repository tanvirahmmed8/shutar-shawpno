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
        Schema::create('error_logs', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('status_code');
            $table->string('url', 191);
            $table->integer('hit_counts')->default(0);
            $table->string('redirect_url', 191)->nullable();
            $table->string('redirect_status', 191)->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('error_logs');
    }
};
