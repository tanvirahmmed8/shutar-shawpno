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
        Schema::create('admin_wallet_histories', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('admin_id')->nullable();
            $table->double('amount', null, 0)->default(0);
            $table->bigInteger('order_id')->nullable();
            $table->bigInteger('product_id')->nullable();
            $table->string('payment')->default('received');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('admin_wallet_histories');
    }
};
