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
        Schema::create('purchase_events', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('event_type');
            $table->longText('payload');
            $table->string('status', 20)->default('pending');
            $table->timestamp('dispatched_at')->nullable();
            $table->text('error_message')->nullable();
            $table->timestamps();

            $table->index(['event_type', 'status']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('purchase_events');
    }
};
