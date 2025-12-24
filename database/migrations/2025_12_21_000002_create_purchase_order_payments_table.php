<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('purchase_order_payments', function (Blueprint $table) {
            $table->id();
            $table->foreignId('purchase_order_id')->constrained('purchase_orders')->cascadeOnDelete();
            $table->decimal('amount', 20, 6);
            $table->string('currency', 3)->nullable();
            $table->string('payment_method', 50)->nullable();
            $table->string('payment_account_key', 64)->nullable();
            $table->string('payment_account', 191)->nullable();
            $table->string('payment_account_code', 64)->nullable();
            $table->foreignId('finance_account_id')->nullable()->constrained('finance_accounts')->nullOnDelete();
            $table->foreignId('finance_journal_id')->nullable()->constrained('finance_journals')->nullOnDelete();
            $table->timestamp('paid_at')->nullable();
            $table->foreignId('paid_by')->nullable()->constrained('admins')->nullOnDelete();
            $table->string('notes', 500)->nullable();
            $table->timestamps();

            $table->index(['purchase_order_id', 'paid_at']);
        });

        Schema::table('purchase_orders', function (Blueprint $table) {
            $table->decimal('paid_total', 20, 6)->default(0)->after('grand_total');
            $table->string('payment_status', 20)->default('unpaid')->after('paid_at');
        });
    }

    public function down(): void
    {
        Schema::table('purchase_orders', function (Blueprint $table) {
            $table->dropColumn(['paid_total', 'payment_status']);
        });
        Schema::dropIfExists('purchase_order_payments');
    }
};
