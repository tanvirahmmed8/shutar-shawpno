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
            $table->bigIncrements('id');
            $table->unsignedBigInteger('account_id');
            $table->string('statement_name');
            $table->date('statement_date')->nullable()->index();
            $table->string('import_source', 120)->nullable();
            $table->decimal('opening_balance', 24, 6)->default(0);
            $table->decimal('closing_balance', 24, 6)->default(0);
            $table->unsignedInteger('statement_row_count')->default(0);
            $table->unsignedInteger('matched_row_count')->default(0);
            $table->string('status', 20)->default('pending');
            $table->text('notes')->nullable();
            $table->timestamp('started_at')->nullable();
            $table->timestamp('completed_at')->nullable();
            $table->unsignedBigInteger('created_by')->nullable()->index('finance_reconciliations_created_by_foreign');
            $table->unsignedBigInteger('updated_by')->nullable()->index('finance_reconciliations_updated_by_foreign');
            $table->softDeletes();
            $table->timestamps();

            $table->index(['account_id', 'status']);
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
