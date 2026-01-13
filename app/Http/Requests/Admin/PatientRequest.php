<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class PatientRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        $patient = $this->route('patient');

        return [
            'patient_first_name'  => 'required|string|max:50',
            'patient_last_name'   => 'required|string|max:50',

            'patient_email' => [
                'required',
                'email',
                Rule::unique('patients', 'patient_email')
                    ->when(
                        $patient,
                        fn ($rule) => $rule->ignore($patient->patient_id, 'patient_id')
                    ),
            ],

            'patient_phone'       => 'required|string|max:15',
            'patient_gender'      => 'required|in:Male,Female,Other',
            'patient_blood_group' => 'required|string|max:10',
            'patient_dob'         => 'required|date',
            'patient_address'     => 'required|string',
            'patient_status'      => 'nullable|boolean',
        ];
    }
}
