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
        Schema::create('purchase_approval_steps', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('route_id');
            $table->unsignedTinyInteger('step_order');
            $table->unsignedBigInteger('approver_id')->nullable()->index('purchase_approval_steps_approver_id_foreign');
            $table->string('fallback_role', 100)->nullable();
            $table->decimal('threshold_amount', 18, 4)->nullable();
            $table->boolean('auto_approve')->default(false);
            $table->unsignedInteger('escalate_after_hours')->nullable();
            $table->unsignedBigInteger('created_by')->nullable()->index('purchase_approval_steps_created_by_foreign');
            $table->unsignedBigInteger('updated_by')->nullable()->index('purchase_approval_steps_updated_by_foreign');
            $table->timestamps();

            $table->unique(['route_id', 'step_order']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('purchase_approval_steps');
    }
};
