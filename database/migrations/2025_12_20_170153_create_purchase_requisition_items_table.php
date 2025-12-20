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
        Schema::create('purchase_requisition_items', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('requisition_id')->index('purchase_requisition_items_requisition_id_foreign');
            $table->unsignedBigInteger('product_id')->nullable()->index();
            $table->string('description');
            $table->string('uom', 32);
            $table->decimal('quantity', 18, 4);
            $table->decimal('unit_price', 18, 4)->default(0);
            $table->decimal('line_total', 18, 4)->default(0);
            $table->date('delivery_date')->nullable();
            $table->longText('metadata')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('purchase_requisition_items');
    }
};
