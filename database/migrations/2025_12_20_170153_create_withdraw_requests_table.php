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
        Schema::create('withdraw_requests', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('seller_id')->nullable();
            $table->bigInteger('delivery_man_id')->nullable();
            $table->bigInteger('admin_id')->nullable();
            $table->string('amount')->default('0.00');
            $table->unsignedBigInteger('withdrawal_method_id')->nullable();
            $table->longText('withdrawal_method_fields')->nullable();
            $table->text('transaction_note')->nullable();
            $table->unsignedBigInteger('finance_journal_id')->nullable();
            $table->boolean('approved')->default(false);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('withdraw_requests');
    }
};
