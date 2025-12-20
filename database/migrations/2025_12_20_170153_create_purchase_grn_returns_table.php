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
        Schema::create('purchase_grn_returns', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('grn_id')->index('purchase_grn_returns_grn_id_foreign');
            $table->unsignedBigInteger('order_id')->index('purchase_grn_returns_order_id_foreign');
            $table->unsignedBigInteger('vendor_id')->index('purchase_grn_returns_vendor_id_foreign');
            $table->unsignedBigInteger('initiated_by')->index('purchase_grn_returns_initiated_by_foreign');
            $table->string('status', 30)->default('draft');
            $table->string('carrier', 120)->nullable();
            $table->string('tracking_number', 120)->nullable();
            $table->text('return_reason')->nullable();
            $table->text('notes')->nullable();
            $table->timestamp('shipped_at')->nullable();
            $table->timestamp('closed_at')->nullable();
            $table->unsignedBigInteger('finance_journal_id')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('purchase_grn_returns');
    }
};
