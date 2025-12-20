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
        Schema::create('purchase_order_approvals', function (Blueprint $table) {
            $table->id();
            $table->morphs('approvable');
            $table->unsignedTinyInteger('step');
            $table->foreignId('approver_id')->constrained('admins')->cascadeOnDelete();
            $table->string('status', 20)->default('pending');
            $table->timestamp('acted_at')->nullable();
            $table->text('comments')->nullable();
            $table->foreignId('delegated_to')->nullable()->constrained('admins')->nullOnDelete();
            $table->timestamps();

            $table->index(['approver_id', 'status']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('purchase_order_approvals');
    }
};
