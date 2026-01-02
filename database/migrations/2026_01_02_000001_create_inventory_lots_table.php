<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('inventory_lots', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->foreignId('product_id')->constrained()->cascadeOnUpdate()->restrictOnDelete();
            $table->string('source_type')->nullable();
            $table->unsignedBigInteger('source_id')->nullable();
            $table->foreignId('grn_id')->nullable()->constrained('purchase_grns')->nullOnDelete();
            $table->foreignId('grn_item_id')->nullable()->constrained('purchase_grn_items')->nullOnDelete();
            $table->foreignId('order_item_id')->nullable()->constrained('purchase_order_items')->nullOnDelete();
            $table->string('lot_number')->nullable();
            $table->string('batch_number')->nullable();
            $table->timestamp('purchased_at')->nullable();
            $table->decimal('quantity_received', 18, 4);
            $table->decimal('quantity_available', 18, 4);
            $table->decimal('unit_purchase_price', 18, 4)->default(0);
            $table->string('currency', 12)->nullable();
            $table->json('metadata')->nullable();
            $table->timestamps();

            $table->index(['product_id', 'quantity_available']);
            $table->index(['source_type', 'source_id']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('inventory_lots');
    }
};
