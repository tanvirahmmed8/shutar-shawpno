<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('delivery_man_transactions', function (Blueprint $table) {
            if (! Schema::hasColumn('delivery_man_transactions', 'finance_journal_id')) {
                $table->unsignedBigInteger('finance_journal_id')->nullable()->after('transaction_type');
            }
        });
    }

    public function down(): void
    {
        Schema::table('delivery_man_transactions', function (Blueprint $table) {
            if (Schema::hasColumn('delivery_man_transactions', 'finance_journal_id')) {
                $table->dropColumn('finance_journal_id');
            }
        });
    }
};
