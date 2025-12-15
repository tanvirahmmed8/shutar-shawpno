<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::table('purchase_grns', function (Blueprint $table) {
            if (!Schema::hasColumn('purchase_grns', 'finance_journal_id')) {
                $table->unsignedBigInteger('finance_journal_id')->nullable()->after('inventory_synced_at');
            }
        });

        Schema::table('purchase_invoices', function (Blueprint $table) {
            if (!Schema::hasColumn('purchase_invoices', 'finance_journal_id')) {
                $table->unsignedBigInteger('finance_journal_id')->nullable()->after('match_variance');
            }
        });

        Schema::table('purchase_grn_returns', function (Blueprint $table) {
            if (!Schema::hasColumn('purchase_grn_returns', 'finance_journal_id')) {
                $table->unsignedBigInteger('finance_journal_id')->nullable()->after('closed_at');
            }
        });
    }

    public function down(): void
    {
        Schema::table('purchase_grns', function (Blueprint $table) {
            if (Schema::hasColumn('purchase_grns', 'finance_journal_id')) {
                $table->dropColumn('finance_journal_id');
            }
        });

        Schema::table('purchase_invoices', function (Blueprint $table) {
            if (Schema::hasColumn('purchase_invoices', 'finance_journal_id')) {
                $table->dropColumn('finance_journal_id');
            }
        });

        Schema::table('purchase_grn_returns', function (Blueprint $table) {
            if (Schema::hasColumn('purchase_grn_returns', 'finance_journal_id')) {
                $table->dropColumn('finance_journal_id');
            }
        });
    }
};
