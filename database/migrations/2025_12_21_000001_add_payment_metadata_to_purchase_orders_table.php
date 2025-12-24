<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('purchase_orders', function (Blueprint $table) {
            $table->string('payment_method', 50)->nullable()->after('payment_terms');
            $table->string('payment_account_key', 64)->nullable()->after('payment_method');
            $table->string('payment_account', 191)->nullable()->after('payment_account_key');
            $table->string('payment_account_code', 64)->nullable()->after('payment_account');
            $table->unsignedBigInteger('finance_journal_id')->nullable()->after('payment_account_code');
            $table->timestamp('paid_at')->nullable()->after('finance_journal_id');
        });
    }

    public function down(): void
    {
        Schema::table('purchase_orders', function (Blueprint $table) {
            $table->dropColumn([
                'payment_method',
                'payment_account_key',
                'payment_account',
                'payment_account_code',
                'finance_journal_id',
                'paid_at',
            ]);
        });
    }
};
