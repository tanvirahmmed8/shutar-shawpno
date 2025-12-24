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
        Schema::create('finance_journal_rows', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('journal_id');
            $table->unsignedBigInteger('account_id')->index();
            $table->unsignedInteger('line_number');
            $table->string('entry_type', 10);
            $table->decimal('amount', 24, 6);
            $table->char('currency', 3)->nullable();
            $table->decimal('exchange_rate', 18, 6)->default(1);
            $table->string('description')->nullable();
            $table->string('reference_type')->nullable();
            $table->unsignedBigInteger('reference_id')->nullable();
            $table->longText('metadata')->nullable();
            $table->timestamps();

            $table->index(['journal_id', 'line_number']);
            $table->index(['reference_type', 'reference_id']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('finance_journal_rows');
    }
};
