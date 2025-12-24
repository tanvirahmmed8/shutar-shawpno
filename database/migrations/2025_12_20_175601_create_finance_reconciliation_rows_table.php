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
        Schema::create('finance_reconciliation_rows', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('reconciliation_id');
            $table->date('transaction_date')->nullable();
            $table->string('description')->nullable();
            $table->string('reference')->nullable();
            $table->decimal('amount', 24, 6);
            $table->char('currency', 3)->nullable();
            $table->string('match_status', 20)->default('unmatched');
            $table->unsignedBigInteger('journal_row_id')->nullable()->index();
            $table->longText('metadata')->nullable();
            $table->timestamps();

            $table->index(['reconciliation_id', 'match_status']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('finance_reconciliation_rows');
    }
};
