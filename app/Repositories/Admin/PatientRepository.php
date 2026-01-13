<?php

namespace App\Repositories\Admin;

use App\Models\Patient;
use App\DTOs\PatientDTO;
use Illuminate\Support\Collection;
use App\Repositories\Admin\PatientRepositoryInterface;

class PatientRepository implements PatientRepositoryInterface
{
    protected Patient $patient;

    public function __construct(Patient $patient)
    {
        $this->patient = $patient;
    }

    public function all(): Collection
    {
        return $this->patient
            ->where('patient_status', 1)
            ->latest()
            ->get();
    }

    public function findById(int $id): ?Patient
    {
        return $this->patient
            ->where('patient_id', $id)
            ->first();
    }

    public function create(PatientDTO $dto): Patient
    {
        return $this->patient->create([
            'patient_code'        => $dto->patientCode,
            'patient_first_name'  => $dto->firstName,
            'patient_last_name'   => $dto->lastName,
            'patient_email'       => $dto->email,
            'patient_phone'       => $dto->phone,
            'patient_blood_group' => $dto->bloodGroup,
            'patient_gender'      => $dto->gender,
            'patient_dob'         => $dto->dob,
            'patient_address'     => $dto->address,
            'patient_status'      => $dto->status ?? 1,
        ]);
    }

    public function update(Patient $patient, PatientDTO $dto): Patient
    {
        $patient->update([
            'patient_first_name'  => $dto->firstName,
            'patient_last_name'   => $dto->lastName,
            'patient_email'       => $dto->email,
            'patient_phone'       => $dto->phone,
            'patient_blood_group' => $dto->bloodGroup,
            'patient_gender'      => $dto->gender,
            'patient_dob'         => $dto->dob,
            'patient_address'     => $dto->address,
            'patient_status'      => $dto->status,
        ]);

        return $patient->fresh();
    }

    public function delete(Patient $patient): bool
    {
        return (bool) $patient->delete();
    }
}
