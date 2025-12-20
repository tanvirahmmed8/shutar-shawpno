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
        Schema::create('purchase_order_items', function (Blueprint $table) {
            $table->id();
            $table->foreignId('order_id')->constrained('purchase_orders')->cascadeOnDelete();
            $table->foreignId('requisition_item_id')->nullable()->constrained('purchase_requisition_items')->nullOnDelete();
            $table->foreignId('product_id')->nullable()->constrained()->nullOnDelete();
            $table->string('description');
            $table->string('uom', 32);
            $table->decimal('quantity', 18, 4);
            $table->decimal('received_qty', 18, 4)->default(0);
            $table->decimal('unit_price', 18, 4);
            $table->decimal('tax_percent', 5, 2)->default(0);
            $table->decimal('tax_amount', 18, 4)->default(0);
            $table->decimal('discount_percent', 5, 2)->default(0);
            $table->decimal('discount_amount', 18, 4)->default(0);
            $table->decimal('line_total', 18, 4);
            $table->json('metadata')->nullable();
            $table->timestamps();

            $table->index('product_id');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('purchase_order_items');
    }
};
