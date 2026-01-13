<?php

namespace App\DTOs;

use App\Http\Requests\Admin\DoctorSlotRequest;

class DoctorSlotDTO
{
    public function __construct(
        public readonly int $doctor_id,
        public readonly int $day_of_week,
        public readonly string $start_time,
        public readonly string $end_time,
        public readonly int $slot_duration,
        public readonly int $is_active,
    ) {}

    /**
     * Create DTO from request
     */
    public static function fromRequest(DoctorSlotRequest $request): self
    {
        return new self(
            doctor_id: (int) $request->doctor_id,
            day_of_week: (int) $request->day_of_week,
            start_time: $request->string('start_time'),
            end_time: $request->string('end_time'),
            slot_duration: (int) $request->slot_duration,
            is_active: $request->boolean('is_active') ? 1 : 0,
        );
    }

    /**
     * Convert DTO to array for model
     */
    public function toArray(): array
    {
        return [
            'doctor_id'     => $this->doctor_id,
            'day_of_week'   => $this->day_of_week,
            'start_time'    => $this->start_time,
            'end_time'      => $this->end_time,
            'slot_duration' => $this->slot_duration,
            'is_active'     => $this->is_active,
        ];
    }
}
