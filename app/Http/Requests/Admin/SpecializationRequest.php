<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class SpecializationRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        /** 
         * Works for:
         * - Create  → null
         * - Update  → specialization_id
         */
        $specializationId = optional($this->route('specialization'))->specialization_id;

        return [
            'specialization_name' => [
                'required',
                'string',
                'max:180',
                Rule::unique('specializations', 'specialization_name')
                    ->ignore($specializationId, 'specialization_id'),
            ],

            'specialization_description' => [
                'required',
                'string',
            ],

            // Checkbox → true/false → stored as 1/0
            'specialization_status' => [
                'required',
                'boolean',
            ],
        ];
    }
}
