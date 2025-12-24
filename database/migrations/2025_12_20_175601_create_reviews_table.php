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
        Schema::create('reviews', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('product_id');
            $table->bigInteger('customer_id');
            $table->bigInteger('delivery_man_id')->nullable();
            $table->bigInteger('order_id')->nullable();
            $table->mediumText('comment')->nullable();
            $table->longText('attachment')->nullable();
            $table->integer('rating')->default(0);
            $table->integer('status')->default(1);
            $table->boolean('is_saved')->default(false);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('reviews');
    }
};
