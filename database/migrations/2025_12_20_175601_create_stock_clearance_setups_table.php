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
        Schema::create('stock_clearance_setups', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('setup_by');
            $table->integer('user_id')->nullable();
            $table->integer('shop_id')->nullable();
            $table->boolean('is_active')->default(false);
            $table->string('discount_type')->nullable()->default('percentage');
            $table->decimal('discount_amount', 18, 12)->default(0);
            $table->string('offer_active_time')->nullable();
            $table->time('offer_active_range_start')->nullable();
            $table->time('offer_active_range_end')->nullable();
            $table->boolean('show_in_homepage')->default(false);
            $table->boolean('show_in_homepage_once')->default(false);
            $table->boolean('show_in_shop')->default(true);
            $table->timestamp('duration_start_date')->nullable();
            $table->timestamp('duration_end_date')->nullable();
            $table->timestamp('created_at')->useCurrent();
            $table->timestamp('updated_at')->useCurrent();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('stock_clearance_setups');
    }
};
