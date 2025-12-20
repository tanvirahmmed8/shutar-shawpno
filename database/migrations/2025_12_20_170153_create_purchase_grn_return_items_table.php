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
        Schema::create('purchase_grn_return_items', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('return_id')->index('purchase_grn_return_items_return_id_foreign');
            $table->unsignedBigInteger('grn_item_id')->index('purchase_grn_return_items_grn_item_id_foreign');
            $table->decimal('return_qty', 18, 4);
            $table->string('disposition', 30)->default('vendor');
            $table->string('restock_decision', 30)->nullable();
            $table->text('remarks')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('purchase_grn_return_items');
    }
};
