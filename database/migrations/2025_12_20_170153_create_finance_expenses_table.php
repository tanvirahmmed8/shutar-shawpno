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
        Schema::create('finance_expenses', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('expense_number', 50)->unique();
            $table->unsignedBigInteger('account_id')->nullable()->index('finance_expenses_account_id_foreign');
            $table->string('category', 80)->nullable();
            $table->string('payee_type', 120)->nullable();
            $table->unsignedBigInteger('payee_id')->nullable();
            $table->decimal('amount', 24, 6);
            $table->char('currency', 3);
            $table->decimal('exchange_rate', 18, 6)->default(1);
            $table->date('expense_date')->nullable();
            $table->string('status', 20)->default('draft');
            $table->text('purpose')->nullable();
            $table->unsignedBigInteger('journal_id')->nullable()->index('finance_expenses_journal_id_foreign');
            $table->unsignedBigInteger('submitted_by')->nullable()->index('finance_expenses_submitted_by_foreign');
            $table->unsignedBigInteger('reviewed_by')->nullable()->index('finance_expenses_reviewed_by_foreign');
            $table->unsignedBigInteger('approved_by')->nullable()->index('finance_expenses_approved_by_foreign');
            $table->timestamp('approved_at')->nullable();
            $table->unsignedInteger('attachment_count')->default(0);
            $table->longText('metadata')->nullable();
            $table->softDeletes();
            $table->timestamps();

            $table->index(['payee_type', 'payee_id']);
            $table->index(['status', 'expense_date']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('finance_expenses');
    }
};
