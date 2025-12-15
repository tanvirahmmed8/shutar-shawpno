<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('withdraw_requests', function (Blueprint $table) {
            if (! Schema::hasColumn('withdraw_requests', 'finance_journal_id')) {
                $table->unsignedBigInteger('finance_journal_id')->nullable()->after('transaction_note');
            }
        });
    }

    public function down(): void
    {
        Schema::table('withdraw_requests', function (Blueprint $table) {
            if (Schema::hasColumn('withdraw_requests', 'finance_journal_id')) {
                $table->dropColumn('finance_journal_id');
            }
        });
    }
};
