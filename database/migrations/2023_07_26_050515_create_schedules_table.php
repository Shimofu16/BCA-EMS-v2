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
        Schema::create('schedules', function (Blueprint $table) {
            $table->id();
            $table->string('class_code');
            $table->unsignedBigInteger('subject_id')->nullable();
            $table->unsignedBigInteger('section_id');
            $table->unsignedBigInteger('grade_level_id');
            $table->unsignedBigInteger('sy_id')->nullable();
            $table->unsignedBigInteger('teacher_id')->nullable();
            $table->time('start_time');
            $table->time('end_time');
            $table->foreign('subject_id')->references('id')->on('subjects')->onUpdate('cascade');
            $table->foreign('section_id')->references('id')->on('sections')->onUpdate('cascade');
            $table->foreign('grade_level_id')->references('id')->on('grade_levels')->onUpdate('cascade');
            $table->foreign('sy_id')->references('id')->on('school_years')->onUpdate('cascade');
            $table->foreign('teacher_id')->references('id')->on('teachers')->onUpdate('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('schedules');
    }
};
