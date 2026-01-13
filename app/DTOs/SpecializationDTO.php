<?php

namespace App\DTOs;

use App\Http\Requests\Admin\SpecializationRequest;

class SpecializationDTO
{
    public function __construct(
        public readonly string $specialization_name,
        public readonly string $specialization_description,
        public readonly int $specialization_status,
    ) {}

    /**
     * Create DTO from request
     */
    public static function fromRequest(SpecializationRequest $request): self
    {
        return new self(
            specialization_name: $request->string('specialization_name'),
            specialization_description: $request->string('specialization_description'),
            specialization_status: $request->boolean('specialization_status') ? 1 : 0,
        );
    }

    /**
     * Convert DTO to array for model
     */
    public function toArray(): array
    {
        return [
            'specialization_name'        => $this->specialization_name,
            'specialization_description' => $this->specialization_description,
            'specialization_status'      => $this->specialization_status,
        ];
    }
}
