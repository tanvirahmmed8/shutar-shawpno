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
            $table->bigIncrements('id');
            $table->unsignedBigInteger('order_id')->index('purchase_order_items_order_id_foreign');
            $table->unsignedBigInteger('requisition_item_id')->nullable()->index('purchase_order_items_requisition_item_id_foreign');
            $table->unsignedBigInteger('product_id')->nullable()->index();
            $table->string('description');
            $table->string('uom', 32);
            $table->decimal('quantity', 18, 4);
            $table->decimal('received_qty', 18, 4)->default(0);
            $table->decimal('outstanding_qty', 18, 4)->default(0);
            $table->decimal('unit_price', 18, 4);
            $table->decimal('tax_percent', 5)->default(0);
            $table->decimal('tax_amount', 18, 4)->default(0);
            $table->decimal('discount_percent', 5)->default(0);
            $table->decimal('discount_amount', 18, 4)->default(0);
            $table->decimal('line_total', 18, 4);
            $table->longText('metadata')->nullable();
            $table->timestamps();
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
