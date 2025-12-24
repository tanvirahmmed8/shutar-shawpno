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
        Schema::create('customer_wallet_histories', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('customer_id')->nullable();
            $table->decimal('transaction_amount')->default(0);
            $table->string('transaction_type', 20)->nullable();
            $table->string('transaction_method', 30)->nullable();
            $table->string('transaction_id', 20)->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('customer_wallet_histories');
    }
};
