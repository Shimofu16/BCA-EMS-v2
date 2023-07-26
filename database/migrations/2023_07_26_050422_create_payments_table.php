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
        Schema::create('payments', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('student_id');
            $table->unsignedBigInteger('sy_id');
            $table->unsignedBigInteger('grade_level_id');
            $table->string('mop'); //mode of payment
            $table->string('payment_method');
            $table->bigInteger('amount')->default(0)->nullable(); //amount if the mop is cash
            $table->string('pop')->nullable(); //proof of payment if mop is bank depo.
            $table->string('path')->nullable();
            $table->string('status')->default('pending');
            $table->string('created_by')->nullable();
            $table->string('updated_by')->nullable();
            $table->string('deleted_by')->nullable();
            $table->date('deleted_at')->nullable();
            $table->foreign('student_id')->references('id')->on('students')->onDelete('cascade');
            $table->foreign('sy_id')->references('id')->on('school_years')->onDelete('restrict')->onUpdate('cascade');
            $table->foreign('grade_level_id')->references('id')->on('grade_levels')->onUpdate('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('payments');
    }
};
