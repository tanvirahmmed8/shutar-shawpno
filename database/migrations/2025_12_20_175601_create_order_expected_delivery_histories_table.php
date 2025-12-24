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
        Schema::create('order_expected_delivery_histories', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('order_id');
            $table->bigInteger('user_id');
            $table->string('user_type');
            $table->date('expected_delivery_date');
            $table->string('cause')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('order_expected_delivery_histories');
    }
};
