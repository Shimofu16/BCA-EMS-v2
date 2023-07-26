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
        Schema::create('grades', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('class_id');
            $table->unsignedBigInteger('student_id');
            $table->double('first_grading')->nullable();
            $table->double('second_grading')->nullable();
            $table->double('third_grading')->nullable();
            $table->double('fourth_grading')->nullable();
            $table->double('final_grade')->nullable();
            $table->foreign('class_id')->references('id')->on('schedules')->onUpdate('cascade');
            $table->foreign('student_id')->references('id')->on('students')->onUpdate('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('grades');
    }
};
