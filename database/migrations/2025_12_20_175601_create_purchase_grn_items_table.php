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
        Schema::create('purchase_grn_items', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('grn_id')->index('purchase_grn_items_grn_id_foreign');
            $table->unsignedBigInteger('order_item_id')->index('purchase_grn_items_order_item_id_foreign');
            $table->string('uom', 32)->nullable();
            $table->unsignedBigInteger('product_id')->nullable()->index('purchase_grn_items_product_id_foreign');
            $table->string('batch_number')->nullable();
            $table->string('lot_number')->nullable();
            $table->date('expiry_date')->nullable();
            $table->decimal('received_qty', 18, 4);
            $table->decimal('accepted_qty', 18, 4)->default(0);
            $table->decimal('rejected_qty', 18, 4)->default(0);
            $table->string('storage_location', 120)->nullable();
            $table->longText('serial_numbers')->nullable();
            $table->longText('metadata')->nullable();
            $table->text('inspection_notes')->nullable();
            $table->text('remarks')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('purchase_grn_items');
    }
};
