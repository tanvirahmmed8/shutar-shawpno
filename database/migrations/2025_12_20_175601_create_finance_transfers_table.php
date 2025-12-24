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
        Schema::create('finance_transfers', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('transfer_number', 50)->unique();
            $table->unsignedBigInteger('source_account_id')->index('finance_transfers_source_account_id_foreign');
            $table->unsignedBigInteger('destination_account_id')->index('finance_transfers_destination_account_id_foreign');
            $table->decimal('amount', 24, 6);
            $table->char('currency', 3);
            $table->decimal('exchange_rate', 18, 6)->default(1);
            $table->string('status', 20)->default('draft');
            $table->text('memo')->nullable();
            $table->unsignedBigInteger('journal_id')->nullable()->index('finance_transfers_journal_id_foreign');
            $table->unsignedBigInteger('initiated_by')->nullable()->index('finance_transfers_initiated_by_foreign');
            $table->unsignedBigInteger('approved_by')->nullable()->index('finance_transfers_approved_by_foreign');
            $table->timestamp('initiated_at')->nullable();
            $table->timestamp('approved_at')->nullable();
            $table->unsignedInteger('attachment_count')->default(0);
            $table->longText('metadata')->nullable();
            $table->softDeletes();
            $table->timestamps();

            $table->index(['status', 'initiated_at']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('finance_transfers');
    }
};
