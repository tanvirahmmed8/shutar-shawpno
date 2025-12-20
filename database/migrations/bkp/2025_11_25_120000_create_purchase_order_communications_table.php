<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('purchase_order_communications', function (Blueprint $table) {
            $table->id();
            $table->foreignId('order_id')->constrained('purchase_orders')->cascadeOnDelete();
            $table->string('channel', 40);
            $table->string('recipient')->nullable();
            $table->string('status', 40)->default('queued');
            $table->string('subject')->nullable();
            $table->string('attachment_path')->nullable();
            $table->json('meta')->nullable();
            $table->timestamp('sent_at')->nullable();
            $table->timestamp('delivered_at')->nullable();
            $table->unsignedBigInteger('created_by')->nullable();
            $table->timestamps();

            $table->index(['order_id', 'channel']);
            $table->index(['status', 'channel']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('purchase_order_communications');
    }
};
