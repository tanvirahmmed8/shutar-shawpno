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
            $table->bigIncrements('id');
            $table->string('code')->unique();
            $table->unsignedBigInteger('vendor_id');
            $table->unsignedBigInteger('order_id')->index('purchase_invoices_order_id_foreign');
            $table->unsignedBigInteger('grn_id')->nullable()->index('purchase_invoices_grn_id_foreign');
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
            $table->string('match_status', 20)->default('pending')->index();
            $table->decimal('match_variance', 18, 4)->default(0);
            $table->unsignedBigInteger('finance_journal_id')->nullable();
            $table->unsignedBigInteger('approved_by')->nullable()->index('purchase_invoices_approved_by_foreign');
            $table->timestamp('approved_at')->nullable();
            $table->text('notes')->nullable();
            $table->unsignedBigInteger('created_by')->index('purchase_invoices_created_by_foreign');
            $table->unsignedBigInteger('updated_by')->nullable()->index('purchase_invoices_updated_by_foreign');
            $table->timestamps();

            $table->index(['vendor_id', 'status']);
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
