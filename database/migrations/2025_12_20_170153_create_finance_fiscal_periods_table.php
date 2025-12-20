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
        Schema::create('finance_fiscal_periods', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('name');
            $table->string('fiscal_year', 9);
            $table->date('start_date');
            $table->date('end_date');
            $table->string('status', 20)->default('draft');
            $table->boolean('is_locked')->default(false);
            $table->timestamp('locked_at')->nullable();
            $table->unsignedBigInteger('locked_by')->nullable()->index('finance_fiscal_periods_locked_by_foreign');
            $table->text('notes')->nullable();
            $table->unsignedBigInteger('created_by')->nullable()->index('finance_fiscal_periods_created_by_foreign');
            $table->unsignedBigInteger('updated_by')->nullable()->index('finance_fiscal_periods_updated_by_foreign');
            $table->softDeletes();
            $table->timestamps();

            $table->unique(['fiscal_year', 'name']);
            $table->index(['status', 'start_date']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('finance_fiscal_periods');
    }
};
