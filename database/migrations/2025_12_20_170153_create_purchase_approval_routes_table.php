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
        Schema::create('purchase_approval_routes', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('name', 120);
            $table->string('description')->nullable();
            $table->longText('conditions')->nullable();
            $table->unsignedTinyInteger('priority')->default(0);
            $table->boolean('is_active')->default(true);
            $table->unsignedBigInteger('created_by')->nullable()->index('purchase_approval_routes_created_by_foreign');
            $table->unsignedBigInteger('updated_by')->nullable()->index('purchase_approval_routes_updated_by_foreign');
            $table->softDeletes();
            $table->timestamps();

            $table->index(['is_active', 'priority']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('purchase_approval_routes');
    }
};
