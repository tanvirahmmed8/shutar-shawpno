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
        Schema::create('delivery_men', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('seller_id')->nullable();
            $table->string('f_name', 100)->nullable();
            $table->string('l_name', 100)->nullable();
            $table->text('address')->nullable();
            $table->string('country_code', 20)->nullable();
            $table->string('phone', 20);
            $table->string('email', 100)->nullable();
            $table->string('identity_number', 30)->nullable();
            $table->string('identity_type', 50)->nullable();
            $table->string('identity_image')->nullable();
            $table->string('image', 100)->nullable();
            $table->string('password', 100);
            $table->string('bank_name')->nullable();
            $table->string('branch')->nullable();
            $table->string('account_no')->nullable();
            $table->string('holder_name')->nullable();
            $table->boolean('is_active')->default(true);
            $table->tinyInteger('is_online')->default(1);
            $table->timestamps();
            $table->string('auth_token')->default('6yIRXJRRfp78qJsAoKZZ6TTqhzuNJ3TcdvPBmk6n');
            $table->string('fcm_token')->nullable();
            $table->string('app_language')->default('en');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('delivery_men');
    }
};
