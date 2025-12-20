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
            $table->bigIncrements('id');
            $table->string('approvable_type');
            $table->unsignedBigInteger('approvable_id');
            $table->unsignedTinyInteger('step');
            $table->unsignedBigInteger('approver_id');
            $table->string('status', 20)->default('pending');
            $table->timestamp('acted_at')->nullable();
            $table->text('comments')->nullable();
            $table->unsignedBigInteger('delegated_to')->nullable()->index('purchase_order_approvals_delegated_to_foreign');
            $table->timestamps();

            $table->index(['approvable_type', 'approvable_id']);
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
