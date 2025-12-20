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
            $table->id();
            $table->string('expense_number', 50)->unique();
            $table->foreignId('account_id')->nullable()->constrained('finance_accounts')->nullOnDelete();
            $table->string('category', 80)->nullable();
            $table->string('payee_type', 120)->nullable();
            $table->unsignedBigInteger('payee_id')->nullable();
            $table->decimal('amount', 24, 6);
            $table->char('currency', 3);
            $table->decimal('exchange_rate', 18, 6)->default(1);
            $table->date('expense_date')->nullable();
            $table->string('status', 20)->default('draft');
            $table->text('purpose')->nullable();
            $table->foreignId('journal_id')->nullable()->constrained('finance_journals')->nullOnDelete();
            $table->foreignId('submitted_by')->nullable()->constrained('admins')->nullOnDelete();
            $table->foreignId('reviewed_by')->nullable()->constrained('admins')->nullOnDelete();
            $table->foreignId('approved_by')->nullable()->constrained('admins')->nullOnDelete();
            $table->timestamp('approved_at')->nullable();
            $table->unsignedInteger('attachment_count')->default(0);
            $table->json('metadata')->nullable();
            $table->softDeletes();
            $table->timestamps();

            $table->index(['status', 'expense_date']);
            $table->index(['payee_type', 'payee_id']);
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
