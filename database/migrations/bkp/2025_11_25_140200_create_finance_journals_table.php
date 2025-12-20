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
        Schema::create('finance_journals', function (Blueprint $table) {
            $table->id();
            $table->string('journal_number', 50)->unique();
            $table->foreignId('fiscal_period_id')->nullable()->constrained('finance_fiscal_periods')->nullOnDelete();
            $table->date('entry_date');
            $table->string('source_type', 120)->nullable();
            $table->unsignedBigInteger('source_id')->nullable();
            $table->string('source_reference')->nullable();
            $table->char('currency', 3);
            $table->decimal('exchange_rate', 18, 6)->default(1);
            $table->string('status', 20)->default('draft');
            $table->string('category', 40)->nullable();
            $table->text('memo')->nullable();
            $table->unsignedInteger('line_count')->default(0);
            $table->unsignedInteger('attachment_count')->default(0);
            $table->timestamp('posted_at')->nullable();
            $table->foreignId('posted_by')->nullable()->constrained('admins')->nullOnDelete();
            $table->foreignId('created_by')->nullable()->constrained('admins')->nullOnDelete();
            $table->foreignId('updated_by')->nullable()->constrained('admins')->nullOnDelete();
            $table->softDeletes();
            $table->timestamps();

            $table->index(['entry_date', 'status']);
            $table->index(['source_type', 'source_id']);
            $table->index('fiscal_period_id');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('finance_journals');
    }
};
