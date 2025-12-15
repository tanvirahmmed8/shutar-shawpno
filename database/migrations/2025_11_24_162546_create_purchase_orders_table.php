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
            $table->id();
            $table->string('code')->unique();
            $table->foreignId('requisition_id')->nullable()->constrained('purchase_requisitions')->nullOnDelete();
            $table->foreignId('vendor_id')->constrained('purchase_vendors')->cascadeOnDelete();
            $table->foreignId('buyer_id')->constrained('admins')->cascadeOnDelete();
            $table->foreignId('approval_route_id')->nullable()->constrained('purchase_approval_routes')->nullOnDelete();
            $table->char('currency', 3);
            $table->decimal('exchange_rate', 18, 6)->default(1);
            $table->string('status', 40)->default('draft');
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
            $table->timestamp('approved_at')->nullable();
            $table->timestamp('closed_at')->nullable();
            $table->foreignId('created_by')->constrained('admins')->cascadeOnDelete();
            $table->foreignId('updated_by')->nullable()->constrained('admins')->nullOnDelete();
            $table->softDeletes();
            $table->timestamps();

            $table->index(['vendor_id', 'status']);
            $table->index('status');
            $table->index('requisition_id');
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
