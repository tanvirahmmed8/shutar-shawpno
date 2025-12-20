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
        Schema::create('purchase_vendors', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('code')->unique();
            $table->string('display_name');
            $table->string('legal_name')->nullable();
            $table->string('vendor_type')->default('local');
            $table->string('category')->nullable();
            $table->string('website')->nullable();
            $table->string('primary_email')->nullable();
            $table->string('primary_phone')->nullable();
            $table->string('payment_terms')->nullable();
            $table->string('incoterm', 32)->nullable();
            $table->char('currency', 3)->default('USD');
            $table->unsignedSmallInteger('lead_time_days')->default(0);
            $table->decimal('min_order_value', 18, 4)->default(0);
            $table->string('tax_id')->nullable();
            $table->decimal('rating', 5)->default(0);
            $table->enum('status', ['draft', 'active', 'inactive', 'blacklisted'])->default('active');
            $table->longText('tags')->nullable();
            $table->longText('attributes')->nullable();
            $table->date('contract_expires_at')->nullable();
            $table->string('compliance_status')->default('pending');
            $table->text('notes')->nullable();
            $table->unsignedBigInteger('created_by')->nullable()->index();
            $table->unsignedBigInteger('updated_by')->nullable();
            $table->softDeletes();
            $table->timestamps();

            $table->index(['status', 'category']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('purchase_vendors');
    }
};
