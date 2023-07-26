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
        Schema::create('enrollment_logs', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('student_id');
            $table->unsignedBigInteger('grade_level_id');
            $table->unsignedBigInteger('sy_id');
            $table->unsignedBigInteger('section_id')->nullable();
            $table->text('student_type');
            $table->text('department');
            $table->foreign('student_id')->references('id')->on('students')->onUpdate('cascade');
            $table->foreign('grade_level_id')->references('id')->on('grade_levels')->onUpdate('cascade');
            $table->foreign('sy_id')->references('id')->on('school_years')->onUpdate('cascade');
            $table->foreign('section_id')->references('id')->on('sections')->onUpdate('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('enrollment_logs');
    }
};
