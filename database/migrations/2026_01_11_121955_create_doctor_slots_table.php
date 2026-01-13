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
        Schema::create('doctor_slots', function (Blueprint $table) {
            $table->bigIncrements('slot_id');

            $table->foreignId('doctor_id')
                ->constrained('doctors', 'doctor_id')
                ->cascadeOnDelete();

            $table->tinyInteger('day_of_week')
                ->comment('0=Sunday, 1=Monday, 2=Tuesday, 3=Wednesday, 4=Thursday, 5=Friday, 6=Saturday');

            $table->time('start_time');
            $table->time('end_time');

            $table->unsignedSmallInteger('slot_duration')
                ->comment('Slot duration in minutes e.g. 15, 30');

            $table->boolean('is_active')->default(true);

            $table->timestamps();
            $table->softDeletes();

            // Prevent duplicate slots for same doctor & time
            $table->unique(
                ['doctor_id', 'day_of_week', 'start_time', 'end_time'],
                'doctor_slot_unique'
            );
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('doctor_slots');
    }
};
