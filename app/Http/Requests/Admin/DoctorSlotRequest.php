<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class DoctorSlotRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true; // add policy later if needed
    }

    public function rules(): array
    {
        return [
            'doctor_id' => [
                'required',
                'exists:doctors,doctor_id',
            ],
            'day_of_week' => [
                'required',
                'integer',
                'between:0,6',
            ],
            'start_time' => [
                'required',
                'date_format:H:i',
            ],
            'end_time' => [
                'required',
                'date_format:H:i',
                'after:start_time',
            ],
            'slot_duration' => [
                'required',
                'integer',
                'min:5',
                'max:240',
            ],
            'is_active' => [
                'nullable',
                'boolean',
            ],
        ];
    }

    public function messages(): array
    {
        return [
            'doctor_id.required' => 'Doctor is required',
            'day_of_week.between' => 'Day must be between Sunday (0) and Saturday (6)',
            'end_time.after' => 'End time must be after start time',
            'slot_duration.min' => 'Slot duration must be at least 5 minutes',
        ];
    }
}
