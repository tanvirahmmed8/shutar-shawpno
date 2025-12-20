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
        Schema::create('purchase_vendor_metrics', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('vendor_id')->unique();
            $table->unsignedInteger('total_po_count')->default(0);
            $table->decimal('total_spend', 18, 4)->default(0);
            $table->decimal('on_time_percent', 5)->default(0);
            $table->decimal('quality_score', 5)->default(0);
            $table->decimal('rejection_rate', 5)->default(0);
            $table->timestamp('last_po_date')->nullable();
            $table->longText('metadata')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('purchase_vendor_metrics');
    }
};
