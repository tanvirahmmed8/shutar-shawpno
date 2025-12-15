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
        Schema::create('finance_reconciliations', function (Blueprint $table) {
            $table->id();
            $table->foreignId('account_id')->constrained('finance_accounts')->restrictOnDelete();
            $table->string('statement_name');
            $table->date('statement_date')->nullable();
            $table->string('import_source', 120)->nullable();
            $table->decimal('opening_balance', 24, 6)->default(0);
            $table->decimal('closing_balance', 24, 6)->default(0);
            $table->unsignedInteger('statement_row_count')->default(0);
            $table->unsignedInteger('matched_row_count')->default(0);
            $table->string('status', 20)->default('pending');
            $table->text('notes')->nullable();
            $table->timestamp('started_at')->nullable();
            $table->timestamp('completed_at')->nullable();
            $table->foreignId('created_by')->nullable()->constrained('admins')->nullOnDelete();
            $table->foreignId('updated_by')->nullable()->constrained('admins')->nullOnDelete();
            $table->softDeletes();
            $table->timestamps();

            $table->index(['account_id', 'status']);
            $table->index('statement_date');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('finance_reconciliations');
    }
};
