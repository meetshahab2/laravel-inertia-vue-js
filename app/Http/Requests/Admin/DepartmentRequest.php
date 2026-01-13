<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class DepartmentRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        // Get department ID safely from route-model binding
        $departmentId = $this->route('department')?->department_id;

        return [
            'department_name' => [
                'required',
                'string',
                'max:180',
                Rule::unique('departments', 'department_name')
                    ->ignore($departmentId, 'department_id'),
            ],

            'department_description' => [
                'required',
                'string',
            ],

            'department_status' => [
                'required',
                'boolean',
            ],
        ];
    }
}
