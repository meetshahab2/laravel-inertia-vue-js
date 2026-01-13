<?php

namespace App\DTOs;

use Illuminate\Http\Request;

class DepartmentDTO
{
    public function __construct(
        public string $department_name,
        public string $department_description,
        public int $department_status
    ) {}

    /** Create DTO from request */
    public static function fromRequest(Request $request): self
    {
        return new self(
            department_name: $request->department_name,
            department_description: $request->department_description,
            department_status: $request->department_status ? 1 : 2
        );
    }

    /** Convert DTO to array */
    public function toArray(): array
    {
        return [
            'department_name'        => $this->department_name,
            'department_description' => $this->department_description,
            'department_status'      => $this->department_status,
        ];
    }
}
