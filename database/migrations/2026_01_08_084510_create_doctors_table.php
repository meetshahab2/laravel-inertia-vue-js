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
        Schema::create('doctors', function (Blueprint $table) {
            $table->id('doctor_id');
            $table->unsignedBigInteger('specialization_id');
            $table->unsignedBigInteger('department_id');
            $table->string('doctor_code',20)->unique();
            $table->string('doctor_first_name',50);
            $table->string('doctor_last_name',50);
            $table->string('doctor_email',180);
            $table->string('doctor_phone',12);
            $table->string('doctor_license_no',30);
            $table->string('doctor_experience_years',30);
            $table->string('doctor_consultation_fee',30);
            $table->text('doctor_description');
            $table->timestamps();
            $table->foreign('specialization_id')->references('specialization_id')->on('specializations')->onDelete('cascade');
            $table->foreign('department_id')->references('department_id')->on('departments')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('doctors');
    }
};
