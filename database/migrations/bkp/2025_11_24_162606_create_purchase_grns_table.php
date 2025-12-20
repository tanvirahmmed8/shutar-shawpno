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
        Schema::create('purchase_grns', function (Blueprint $table) {
            $table->id();
            $table->string('code')->unique();
            $table->foreignId('order_id')->constrained('purchase_orders')->cascadeOnDelete();
            $table->unsignedBigInteger('warehouse_id')->nullable();
            $table->foreignId('received_by')->constrained('admins')->cascadeOnDelete();
            $table->foreignId('checked_by')->nullable()->constrained('admins')->nullOnDelete();
            $table->string('status', 30)->default('draft');
            $table->timestamp('received_at');
            $table->text('remarks')->nullable();
            $table->text('rejection_reason')->nullable();
            $table->foreignId('created_by')->constrained('admins')->cascadeOnDelete();
            $table->foreignId('updated_by')->nullable()->constrained('admins')->nullOnDelete();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('purchase_grns');
    }
};
