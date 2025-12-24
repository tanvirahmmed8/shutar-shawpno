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
        Schema::create('order_partial_payments', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('order_id')->index('order_partial_payments_order_id_foreign');
            $table->decimal('amount', 24);
            $table->string('payment_method')->nullable();
            $table->string('payment_account')->nullable();
            $table->string('payment_account_code', 64)->nullable();
            $table->string('reference')->nullable();
            $table->text('note')->nullable();
            $table->timestamp('paid_at')->nullable();
            $table->unsignedBigInteger('created_by')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('order_partial_payments');
    }
};
