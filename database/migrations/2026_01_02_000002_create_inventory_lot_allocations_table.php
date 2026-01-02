<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('inventory_lot_allocations', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->foreignId('lot_id')->constrained('inventory_lots')->cascadeOnUpdate()->restrictOnDelete();
            $table->foreignId('order_detail_id')->constrained('order_details')->cascadeOnUpdate()->restrictOnDelete();
            $table->foreignId('product_id')->constrained()->cascadeOnUpdate()->restrictOnDelete();
            $table->decimal('quantity', 18, 4);
            $table->decimal('unit_purchase_price', 18, 4)->default(0);
            $table->decimal('unit_sale_price', 18, 4)->default(0);
            $table->decimal('profit_amount', 18, 4)->default(0);
            $table->timestamp('released_at')->nullable();
            $table->json('metadata')->nullable();
            $table->timestamps();

            $table->index(['order_detail_id', 'released_at']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('inventory_lot_allocations');
    }
};
