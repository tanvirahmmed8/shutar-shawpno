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
        Schema::create('sellers', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('f_name', 30)->nullable();
            $table->string('l_name', 30)->nullable();
            $table->string('phone', 25)->nullable();
            $table->string('image', 30)->default('def.png');
            $table->string('email', 80)->unique();
            $table->string('password', 80)->nullable();
            $table->string('status', 15)->default('pending');
            $table->rememberToken();
            $table->timestamps();
            $table->string('bank_name')->nullable();
            $table->string('branch')->nullable();
            $table->string('account_no')->nullable();
            $table->string('holder_name')->nullable();
            $table->text('auth_token')->nullable();
            $table->double('sales_commission_percentage', 8, 2)->nullable();
            $table->string('gst')->nullable();
            $table->string('cm_firebase_token')->nullable();
            $table->boolean('pos_status')->default(false);
            $table->double('minimum_order_amount', 8, 2)->default(0);
            $table->integer('free_delivery_status')->default(0);
            $table->double('free_delivery_over_amount', 8, 2)->default(0);
            $table->string('app_language')->default('en');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('sellers');
    }
};
