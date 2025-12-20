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
        Schema::create('purchase_requisitions', function (Blueprint $table) {
            $table->id();
            $table->string('code')->unique();
            $table->foreignId('requester_id')->constrained('admins')->cascadeOnDelete();
            $table->unsignedBigInteger('cost_center_id')->nullable();
            $table->string('priority', 20)->default('medium');
            $table->string('status', 40)->default('draft');
            $table->date('needed_by')->nullable();
            $table->text('justification')->nullable();
            $table->char('currency', 3);
            $table->decimal('subtotal', 18, 4)->default(0);
            $table->decimal('tax_total', 18, 4)->default(0);
            $table->decimal('grand_total', 18, 4)->default(0);
            $table->unsignedBigInteger('approval_route_id')->nullable();
            $table->timestamp('approved_at')->nullable();
            $table->text('rejected_reason')->nullable();
            $table->foreignId('created_by')->constrained('admins')->cascadeOnDelete();
            $table->foreignId('updated_by')->nullable()->constrained('admins')->nullOnDelete();
            $table->softDeletes();
            $table->timestamps();

            $table->index(['requester_id', 'status']);
            $table->index(['status', 'needed_by']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('purchase_requisitions');
    }
};
