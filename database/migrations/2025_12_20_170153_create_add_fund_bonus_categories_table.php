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
        Schema::create('add_fund_bonus_categories', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('title', 255)->nullable();
            $table->text('description')->nullable();
            $table->string('bonus_type', 50);
            $table->double('bonus_amount', 14, 2)->default(0);
            $table->double('min_add_money_amount', 14, 2)->default(0);
            $table->double('max_bonus_amount', 14, 2)->default(0);
            $table->dateTime('start_date_time')->nullable();
            $table->dateTime('end_date_time')->nullable();
            $table->boolean('is_active')->default(false);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('add_fund_bonus_categories');
    }
};
