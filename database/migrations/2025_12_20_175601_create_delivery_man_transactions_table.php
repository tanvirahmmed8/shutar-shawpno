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
        Schema::create('delivery_man_transactions', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('delivery_man_id');
            $table->bigInteger('user_id');
            $table->string('user_type', 20);
            $table->char('transaction_id', 36);
            $table->decimal('debit', 50)->default(0);
            $table->decimal('credit', 50)->default(0);
            $table->string('transaction_type', 20);
            $table->unsignedBigInteger('finance_journal_id')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('delivery_man_transactions');
    }
};
