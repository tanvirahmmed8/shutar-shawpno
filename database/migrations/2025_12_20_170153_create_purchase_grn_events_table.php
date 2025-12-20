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
        Schema::create('purchase_grn_events', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('grn_id');
            $table->string('event_type', 60);
            $table->longText('payload')->nullable();
            $table->unsignedBigInteger('created_by')->nullable()->index('purchase_grn_events_created_by_foreign');
            $table->timestamps();

            $table->index(['grn_id', 'event_type']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('purchase_grn_events');
    }
};
