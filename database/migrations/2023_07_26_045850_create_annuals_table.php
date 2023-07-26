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
        Schema::create('annuals', function (Blueprint $table) {
            $table->id();
            $table->text('title');
            $table->double('amount')->default(0);
            $table->text('fee_type');
            $table->unsignedBigInteger('level_id');
            $table->unsignedBigInteger('sy_id');
            $table->foreign('level_id')->references('id')->on('levels')->onUpdate('cascade');
            $table->foreign('sy_id')->references('id')->on('school_years')->onUpdate('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('annuals');
    }
};
