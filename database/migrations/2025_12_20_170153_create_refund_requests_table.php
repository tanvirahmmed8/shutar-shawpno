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
        Schema::create('refund_requests', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('order_details_id');
            $table->unsignedBigInteger('customer_id');
            $table->string('status');
            $table->tinyInteger('approved_count')->default(0);
            $table->tinyInteger('denied_count')->default(0);
            $table->double('amount', 8, 2);
            $table->unsignedBigInteger('product_id');
            $table->unsignedBigInteger('order_id');
            $table->longText('refund_reason');
            $table->text('images')->nullable();
            $table->timestamps();
            $table->longText('approved_note')->nullable();
            $table->longText('rejected_note')->nullable();
            $table->longText('payment_info')->nullable();
            $table->string('change_by')->nullable();
            $table->unsignedBigInteger('finance_journal_id')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('refund_requests');
    }
};
