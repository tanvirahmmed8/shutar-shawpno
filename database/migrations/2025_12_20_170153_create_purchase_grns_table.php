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
        Schema::create('purchase_grns', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('code')->unique();
            $table->unsignedBigInteger('order_id')->index('purchase_grns_order_id_foreign');
            $table->unsignedBigInteger('warehouse_id')->nullable();
            $table->unsignedBigInteger('received_by')->index('purchase_grns_received_by_foreign');
            $table->unsignedBigInteger('checked_by')->nullable()->index('purchase_grns_checked_by_foreign');
            $table->string('status', 30)->default('draft');
            $table->timestamp('reviewed_at')->nullable();
            $table->timestamp('approved_at')->nullable();
            $table->timestamp('delivered_at')->nullable();
            $table->decimal('inspection_score', 5)->nullable();
            $table->string('carrier', 120)->nullable();
            $table->string('return_reference', 120)->nullable();
            $table->unsignedInteger('attachments_count')->default(0);
            $table->string('inventory_sync_status', 30)->default('pending');
            $table->longText('inventory_sync_payload')->nullable();
            $table->timestamp('inventory_synced_at')->nullable();
            $table->unsignedBigInteger('finance_journal_id')->nullable();
            $table->timestamp('received_at');
            $table->text('remarks')->nullable();
            $table->text('rejection_reason')->nullable();
            $table->unsignedBigInteger('created_by')->index('purchase_grns_created_by_foreign');
            $table->unsignedBigInteger('updated_by')->nullable()->index('purchase_grns_updated_by_foreign');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('purchase_grns');
    }
};
