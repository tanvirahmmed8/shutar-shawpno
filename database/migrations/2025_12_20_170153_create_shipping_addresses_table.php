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
        Schema::create('shipping_addresses', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('customer_id', 15)->nullable();
            $table->tinyInteger('is_guest')->default(0);
            $table->string('contact_person_name', 50)->nullable();
            $table->string('email', 255)->nullable();
            $table->string('address_type', 20)->default('home');
            $table->string('address', 255)->nullable();
            $table->string('city', 50)->nullable();
            $table->string('zip', 10)->nullable();
            $table->string('phone', 20)->nullable();
            $table->timestamps();
            $table->string('state')->nullable();
            $table->string('country')->nullable();
            $table->string('latitude')->nullable();
            $table->string('longitude')->nullable();
            $table->boolean('is_billing')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('shipping_addresses');
    }
};
