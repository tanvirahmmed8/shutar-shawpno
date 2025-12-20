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
        Schema::create('carts', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('customer_id')->nullable();
            $table->string('cart_group_id')->nullable();
            $table->bigInteger('product_id')->nullable();
            $table->string('product_type', 20)->default('physical');
            $table->string('digital_product_type', 30)->nullable();
            $table->string('color')->nullable();
            $table->text('choices')->nullable();
            $table->text('variations')->nullable();
            $table->text('variant')->nullable();
            $table->integer('quantity')->default(1);
            $table->double('price', null, 0)->default(1);
            $table->double('tax', null, 0)->default(1);
            $table->double('discount', null, 0)->default(1);
            $table->string('tax_model', 20)->default('exclude');
            $table->boolean('is_checked')->default(false);
            $table->string('slug')->nullable();
            $table->string('name')->nullable();
            $table->string('thumbnail')->nullable();
            $table->bigInteger('seller_id')->nullable();
            $table->string('seller_is')->default('admin');
            $table->timestamps();
            $table->string('shop_info')->nullable();
            $table->double('shipping_cost', 8, 2)->nullable();
            $table->string('shipping_type')->nullable();
            $table->tinyInteger('is_guest')->default(0);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('carts');
    }
};
