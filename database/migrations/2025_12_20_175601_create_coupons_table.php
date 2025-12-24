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
        Schema::create('coupons', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('added_by')->default('admin');
            $table->string('coupon_type', 50)->nullable();
            $table->string('coupon_bearer')->default('inhouse');
            $table->bigInteger('seller_id')->nullable()->comment('NULL=in-house, 0=all seller');
            $table->bigInteger('customer_id')->nullable()->comment('0 = all customer');
            $table->string('title', 100)->nullable();
            $table->string('code', 15)->nullable();
            $table->date('start_date')->nullable();
            $table->date('expire_date')->nullable();
            $table->decimal('min_purchase')->default(0);
            $table->decimal('max_discount')->default(0);
            $table->decimal('discount')->default(0);
            $table->string('discount_type', 15)->default('percentage');
            $table->boolean('status')->default(true);
            $table->timestamps();
            $table->integer('limit')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('coupons');
    }
};
