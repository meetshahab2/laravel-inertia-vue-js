<?php

namespace App\DTOs;

use Illuminate\Http\Request;
use Illuminate\Support\Str;

class PatientDTO
{
    public function __construct(
        public readonly string $patientCode,
        public readonly string $firstName,
        public readonly string $lastName,
        public readonly string $email,
        public readonly string $phone,
        public readonly string $gender,
        public readonly string $bloodGroup,
        public readonly string $dob,
        public readonly string $address,
        public readonly int $status,
    ) {}

    public static function fromRequest(Request $request): self
    {
        return new self(
            patientCode: $request->patient_code ?? self::generatePatientCode(),
            firstName: $request->patient_first_name,
            lastName: $request->patient_last_name,
            email: $request->patient_email,
            phone: $request->patient_phone,
            gender: $request->patient_gender,
            bloodGroup: $request->patient_blood_group,
            dob: $request->patient_dob,
            address: $request->patient_address,
            status: $request->boolean('patient_status') ? 1 : 2,
        );
    }

    protected static function generatePatientCode(): string
    {
        return 'PAT' . strtoupper(Str::random(6));
    }

    public function toArray(): array
    {
        return [
            'patient_code'        => $this->patientCode,
            'patient_first_name'  => $this->firstName,
            'patient_last_name'   => $this->lastName,
            'patient_email'       => $this->email,
            'patient_phone'       => $this->phone,
            'patient_gender'      => $this->gender,
            'patient_blood_group' => $this->bloodGroup,
            'patient_dob'         => $this->dob,
            'patient_address'     => $this->address,
            'patient_status'      => $this->status,
        ];
    }
}
