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
        Schema::create('purchase_invoices', function (Blueprint $table) {
            $table->id();
            $table->string('code')->unique();
            $table->foreignId('vendor_id')->constrained('sellers')->cascadeOnDelete();
            $table->foreignId('order_id')->constrained('purchase_orders')->cascadeOnDelete();
            $table->foreignId('grn_id')->nullable()->constrained('purchase_grns')->nullOnDelete();
            $table->string('status', 30)->default('draft');
            $table->string('invoice_number');
            $table->date('invoice_date');
            $table->date('due_date');
            $table->char('currency', 3);
            $table->decimal('exchange_rate', 18, 6)->default(1);
            $table->decimal('subtotal', 18, 4)->default(0);
            $table->decimal('tax_total', 18, 4)->default(0);
            $table->decimal('discount_total', 18, 4)->default(0);
            $table->decimal('freight_total', 18, 4)->default(0);
            $table->decimal('grand_total', 18, 4)->default(0);
            $table->string('match_status', 20)->default('pending');
            $table->decimal('match_variance', 18, 4)->default(0);
            $table->foreignId('approved_by')->nullable()->constrained('admins')->nullOnDelete();
            $table->timestamp('approved_at')->nullable();
            $table->text('notes')->nullable();
            $table->foreignId('created_by')->constrained('admins')->cascadeOnDelete();
            $table->foreignId('updated_by')->nullable()->constrained('admins')->nullOnDelete();
            $table->timestamps();

            $table->index(['vendor_id', 'status']);
            $table->index('match_status');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('purchase_invoices');
    }
};
