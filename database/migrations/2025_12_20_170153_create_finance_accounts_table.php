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
        Schema::create('finance_accounts', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('code', 64)->unique();
            $table->string('name');
            $table->string('category', 40);
            $table->string('type', 40)->default('posting');
            $table->text('description')->nullable();
            $table->unsignedBigInteger('parent_id')->nullable()->index();
            $table->unsignedTinyInteger('level')->default(1);
            $table->boolean('is_leaf')->default(true);
            $table->boolean('is_active')->default(true);
            $table->boolean('is_postable')->default(true);
            $table->char('currency', 3)->nullable();
            $table->string('balance_type', 10)->default('debit');
            $table->decimal('opening_balance', 24, 6)->default(0);
            $table->longText('metadata')->nullable();
            $table->unsignedBigInteger('created_by')->nullable()->index('finance_accounts_created_by_foreign');
            $table->unsignedBigInteger('updated_by')->nullable()->index('finance_accounts_updated_by_foreign');
            $table->softDeletes();
            $table->timestamps();

            $table->index(['category', 'is_active']);
            $table->index(['is_postable', 'balance_type']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('finance_accounts');
    }
};
