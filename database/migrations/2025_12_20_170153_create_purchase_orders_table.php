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
        Schema::create('purchase_orders', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('code')->unique();
            $table->unsignedBigInteger('requisition_id')->nullable()->index();
            $table->unsignedBigInteger('vendor_id');
            $table->unsignedBigInteger('buyer_id')->index('purchase_orders_buyer_id_foreign');
            $table->unsignedBigInteger('approval_route_id')->nullable()->index('purchase_orders_approval_route_id_foreign');
            $table->char('currency', 3);
            $table->decimal('exchange_rate', 18, 6)->default(1);
            $table->string('status', 40)->default('draft')->index();
            $table->string('receiving_status', 30)->default('not_received');
            $table->decimal('received_percent', 5)->default(0);
            $table->string('payment_terms')->nullable();
            $table->decimal('freight_cost', 18, 4)->default(0);
            $table->decimal('tax_total', 18, 4)->default(0);
            $table->decimal('subtotal', 18, 4)->default(0);
            $table->decimal('discount_total', 18, 4)->default(0);
            $table->decimal('grand_total', 18, 4)->default(0);
            $table->date('expected_delivery')->nullable();
            $table->text('notes_internal')->nullable();
            $table->text('notes_vendor')->nullable();
            $table->timestamp('sent_at')->nullable();
            $table->timestamp('last_receipt_at')->nullable();
            $table->timestamp('approved_at')->nullable();
            $table->timestamp('closed_at')->nullable();
            $table->unsignedBigInteger('created_by')->index('purchase_orders_created_by_foreign');
            $table->unsignedBigInteger('updated_by')->nullable()->index('purchase_orders_updated_by_foreign');
            $table->softDeletes();
            $table->timestamps();

            $table->index(['vendor_id', 'status']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('purchase_orders');
    }
};
