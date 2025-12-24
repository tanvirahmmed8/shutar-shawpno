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
        Schema::create('translations', function (Blueprint $table) {
            $table->string('translationable_type');
            $table->unsignedBigInteger('translationable_id')->index();
            $table->string('locale')->index();
            $table->string('key')->nullable();
            $table->text('value')->nullable();
            $table->bigIncrements('id');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('translations');
    }
};
