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
            $table->id();
            $table->foreignId('reconciliation_id')->constrained('finance_reconciliations')->cascadeOnDelete();
            $table->date('transaction_date')->nullable();
            $table->string('description')->nullable();
            $table->string('reference')->nullable();
            $table->decimal('amount', 24, 6);
            $table->char('currency', 3)->nullable();
            $table->string('match_status', 20)->default('unmatched');
            $table->foreignId('journal_row_id')->nullable()->constrained('finance_journal_rows')->nullOnDelete();
            $table->json('metadata')->nullable();
            $table->timestamps();

            $table->index(['reconciliation_id', 'match_status']);
            $table->index('journal_row_id');
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
