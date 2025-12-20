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
            $table->id();
            $table->foreignId('route_id')->constrained('purchase_approval_routes')->cascadeOnDelete();
            $table->unsignedTinyInteger('step_order');
            $table->foreignId('approver_id')->nullable()->constrained('admins')->nullOnDelete();
            $table->string('fallback_role', 100)->nullable();
            $table->decimal('threshold_amount', 18, 4)->nullable();
            $table->boolean('auto_approve')->default(false);
            $table->unsignedInteger('escalate_after_hours')->nullable();
            $table->foreignId('created_by')->nullable()->constrained('admins')->nullOnDelete();
            $table->foreignId('updated_by')->nullable()->constrained('admins')->nullOnDelete();
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
