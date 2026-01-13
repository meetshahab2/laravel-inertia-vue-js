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
        Schema::create('patients', function (Blueprint $table) {
            $table->id('patient_id');
            $table->string('patient_code',10)->unique();
            $table->string('patient_first_name',50);
            $table->string('patient_last_name',50);
            $table->string('patient_email',180);
            $table->string('patient_phone',12);
            $table->string('patient_blood_group',15);
            $table->string('patient_gender',10);
            $table->date('patient_dob');
            $table->text('patient_address');
            $table->tinyInteger('patient_status')->comment('1 - active,-1-delete,2 - inactive')->default(1);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('patients');
    }
};
