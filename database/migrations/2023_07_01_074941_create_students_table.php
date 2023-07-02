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
        Schema::create('students', function (Blueprint $table) {
            $table->id();
            $table->string('student_id')->unique();
            $table->string('student_lrn', 12)->unique()->nullable();
            $table->string('first_name');
            $table->string('middle_name');
            $table->string('last_name');
            $table->string('ext_name')->nullable();
            $table->string('gender', 6);
            $table->integer('age');
            $table->string('email')->unique();
            $table->date('birth_date')->useCurrent();
            $table->string('birthplace');
            $table->string('address');
            $table->unsignedBigInteger('section_id')->nullable();
            $table->unsignedBigInteger('sy_id');
            $table->unsignedBigInteger('grade_level_id');
            $table->string('student_type');
            $table->string('department');
            $table->text('status')->default(0); //isDone for old student na then an mag enroll
            $table->boolean('enrollmentCompleted')->default(0);
            $table->boolean('hasVerifiedEmail')->default(0);
            $table->boolean('hasPromissoryNote')->default(0);
            $table->string('updated_by')->nullable();
            $table->foreign('section_id')->references('id')->on('sections')->onDelete('cascade');
            $table->foreign('sy_id')->references('id')->on('school_years')->onDelete('cascade');
            $table->foreign('grade_level_id')->references('id')->on('grade_levels')->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('students');
    }
};
