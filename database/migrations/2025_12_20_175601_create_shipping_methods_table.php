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
        Schema::create('shipping_methods', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('creator_id')->nullable();
            $table->string('creator_type')->default('admin');
            $table->string('title', 100)->nullable();
            $table->decimal('cost')->default(0);
            $table->string('duration', 20)->nullable();
            $table->boolean('status')->default(true);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('shipping_methods');
    }
};
