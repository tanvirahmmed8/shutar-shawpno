<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::table('order_partial_payments', function (Blueprint $table) {
            $table->string('payment_account_code', 64)->nullable()->after('payment_account');
        });
    }

    public function down(): void
    {
        Schema::table('order_partial_payments', function (Blueprint $table) {
            $table->dropColumn('payment_account_code');
        });
    }
};
