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
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('name')->nullable();
            $table->string('gender')->nullable();
            $table->string('email')->unique();
            $table->string('password');
            $table->string('status')->default('offline'); //online, offline, deactivated
            $table->unsignedBigInteger('first_role_id');
            $table->unsignedBigInteger('second_role_id')->nullable();
            $table->unsignedBigInteger('teacher_id')->nullable();
            $table->unsignedBigInteger('student_id')->nullable();
            $table->string('otp')->nullable();
            $table->boolean('force_change_password')->default(false);
            $table->foreign('first_role_id')->references('id')->on('roles')->onUpdate('cascade');
            $table->foreign('second_role_id')->references('id')->on('roles')->onUpdate('cascade');
            $table->foreign('teacher_id')->references('id')->on('teachers')->onUpdate('cascade');
            $table->foreign('student_id')->references('id')->on('students')->onUpdate('cascade');
            $table->timestamp('email_verified_at')->nullable();
            $table->rememberToken();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('users');
    }
};
