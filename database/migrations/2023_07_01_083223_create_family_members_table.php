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
        Schema::create('family_members', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('student_id');
            $table->foreign('student_id')
                ->references('id')
                ->on('students')
                ->onUpdate('cascade');
            $table->string('name');
            $table->date('birth_date')->nullable();
            $table->string('landline', 20)->nullable();
            $table->string('contact_no', 11);
            $table->string('address')->nullable();
            $table->string('email')->nullable();
            $table->string('occupation')->nullable();
            $table->string('office_address')->nullable();
            $table->string('office_contact_no', 11)->nullable();
            $table->string('relationship');
            $table->string('relationship_type');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('family_members');
    }
};
