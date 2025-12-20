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
        Schema::create('refund_transactions', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('order_id')->nullable();
            $table->string('payment_for')->nullable();
            $table->unsignedBigInteger('payer_id')->nullable();
            $table->unsignedBigInteger('payment_receiver_id')->nullable();
            $table->string('paid_by')->nullable();
            $table->string('paid_to')->nullable();
            $table->string('payment_method')->nullable();
            $table->string('payment_status')->nullable();
            $table->double('amount', 8, 2)->nullable();
            $table->string('transaction_type')->nullable();
            $table->unsignedBigInteger('order_details_id')->nullable();
            $table->timestamps();
            $table->unsignedBigInteger('refund_id')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('refund_transactions');
    }
};
