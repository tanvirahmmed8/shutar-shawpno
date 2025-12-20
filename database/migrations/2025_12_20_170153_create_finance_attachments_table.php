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
        Schema::create('finance_attachments', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('attachable_type');
            $table->unsignedBigInteger('attachable_id');
            $table->string('category', 40)->nullable();
            $table->string('file_name');
            $table->string('file_path');
            $table->string('mime_type', 120)->nullable();
            $table->unsignedBigInteger('file_size')->default(0);
            $table->unsignedBigInteger('uploaded_by')->nullable()->index('finance_attachments_uploaded_by_foreign');
            $table->timestamp('uploaded_at')->nullable();
            $table->longText('metadata')->nullable();
            $table->timestamps();

            $table->index(['attachable_type', 'attachable_id']);
            $table->index(['attachable_type', 'category']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('finance_attachments');
    }
};
