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
        Schema::create('appointment_slots', function (Blueprint $table) {
            $table->bigIncrements('appointment_slot_id');

            $table->foreignId('appointment_id')
                ->constrained('appointments', 'appointment_id')
                ->cascadeOnDelete();

            $table->foreignId('doctor_id')
                ->constrained('doctors', 'doctor_id')
                ->cascadeOnDelete();

            $table->date('appointment_date');
            $table->time('slot_start_time');
            $table->time('slot_end_time');

            $table->enum('status', ['booked', 'cancelled', 'completed'])
                ->default('booked');

            $table->timestamps();
            $table->softDeletes(); // ✅ Soft delete added

            // 🚫 Prevent double booking for same doctor & time
            $table->unique(
                ['doctor_id', 'appointment_date', 'slot_start_time'],
                'unique_doctor_slot_booking'
            );
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('appointment_slots');
    }
};
