<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::table('orders', function (Blueprint $table) {
            if (!Schema::hasColumn('orders', 'finance_journal_id')) {
                $column = Schema::hasColumn('orders', 'verification_status') ? 'verification_status' : null;

                if ($column) {
                    $table->unsignedBigInteger('finance_journal_id')->nullable()->after($column);
                } else {
                    $table->unsignedBigInteger('finance_journal_id')->nullable();
                }
            }
        });

        Schema::table('refund_requests', function (Blueprint $table) {
            if (!Schema::hasColumn('refund_requests', 'finance_journal_id')) {
                $table->unsignedBigInteger('finance_journal_id')->nullable()->after('change_by');
            }
        });
    }

    public function down(): void
    {
        Schema::table('orders', function (Blueprint $table) {
            if (Schema::hasColumn('orders', 'finance_journal_id')) {
                $table->dropColumn('finance_journal_id');
            }
        });

        Schema::table('refund_requests', function (Blueprint $table) {
            if (Schema::hasColumn('refund_requests', 'finance_journal_id')) {
                $table->dropColumn('finance_journal_id');
            }
        });
    }
};
