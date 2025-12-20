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
        Schema::create('products', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('added_by')->nullable();
            $table->bigInteger('user_id')->nullable();
            $table->string('name', 80)->nullable();
            $table->string('slug', 120)->nullable();
            $table->string('product_type', 20)->default('physical');
            $table->string('category_ids', 80)->nullable();
            $table->string('category_id')->nullable();
            $table->string('sub_category_id')->nullable();
            $table->string('sub_sub_category_id')->nullable();
            $table->bigInteger('brand_id')->nullable();
            $table->string('unit')->nullable();
            $table->integer('min_qty')->default(1);
            $table->boolean('refundable')->default(true);
            $table->string('digital_product_type', 30)->nullable();
            $table->string('digital_file_ready')->nullable();
            $table->string('digital_file_ready_storage_type', 10)->nullable()->default('public');
            $table->longText('images')->nullable();
            $table->text('color_image');
            $table->string('thumbnail', 255)->nullable();
            $table->string('thumbnail_storage_type', 10)->nullable()->default('public');
            $table->string('preview_file', 255)->nullable();
            $table->string('preview_file_storage_type', 255)->nullable()->default('public');
            $table->string('featured', 255)->nullable();
            $table->string('flash_deal', 255)->nullable();
            $table->string('video_provider', 30)->nullable();
            $table->string('video_url', 150)->nullable();
            $table->string('colors', 150)->nullable();
            $table->boolean('variant_product')->default(false);
            $table->string('attributes', 255)->nullable();
            $table->text('choice_options')->nullable();
            $table->text('variation')->nullable();
            $table->longText('digital_product_file_types')->nullable();
            $table->longText('digital_product_extensions')->nullable();
            $table->boolean('published')->default(false);
            $table->double('unit_price', null, 0)->default(0);
            $table->double('purchase_price', null, 0)->default(0);
            $table->string('tax')->default('0.00');
            $table->string('tax_type', 80)->nullable();
            $table->string('tax_model', 20)->default('exclude');
            $table->string('discount')->default('0.00');
            $table->string('discount_type', 80)->nullable();
            $table->integer('current_stock')->nullable();
            $table->integer('minimum_order_qty')->default(1);
            $table->text('details')->nullable();
            $table->boolean('free_shipping')->default(false);
            $table->string('attachment')->nullable();
            $table->timestamps();
            $table->boolean('status')->default(true);
            $table->boolean('featured_status')->default(true);
            $table->string('meta_title')->nullable();
            $table->string('meta_description')->nullable();
            $table->string('meta_image')->nullable();
            $table->boolean('request_status')->default(false);
            $table->text('denied_note')->nullable();
            $table->double('shipping_cost', 8, 2)->nullable();
            $table->boolean('multiply_qty')->nullable();
            $table->double('temp_shipping_cost', 8, 2)->nullable();
            $table->boolean('is_shipping_cost_updated')->nullable();
            $table->string('code')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('products');
    }
};
