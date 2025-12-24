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
            $table->bigIncrements('id');
            $table->string('code')->unique();
            $table->unsignedBigInteger('requester_id');
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
            $table->unsignedBigInteger('created_by')->index('purchase_requisitions_created_by_foreign');
            $table->unsignedBigInteger('updated_by')->nullable()->index('purchase_requisitions_updated_by_foreign');
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
