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
        Schema::create('password_resets', function (Blueprint $table) {
            $table->string('identity')->index('password_resets_email_index');
            $table->string('token');
            $table->tinyInteger('otp_hit_count')->default(0);
            $table->boolean('is_temp_blocked')->default(false);
            $table->timestamp('temp_block_time')->nullable();
            $table->timestamp('expires_at')->nullable();
            $table->timestamps();
            $table->string('user_type')->default('customer');
            $table->bigIncrements('id');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('password_resets');
    }
};
