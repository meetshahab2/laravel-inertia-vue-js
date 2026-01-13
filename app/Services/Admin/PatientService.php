<?php

namespace App\Services\Admin;

use App\Models\Patient;
use App\DTOs\PatientDTO;
use App\Repositories\Admin\PatientRepositoryInterface;

class PatientService
{
    public function __construct(
        protected PatientRepositoryInterface $patientRepository
    ) {}

    public function getAllPatients()
    {
        return $this->patientRepository->all();
    }

    public function createPatient(PatientDTO $dto)
    {
        return $this->patientRepository->create($dto);
    }

    public function updatePatient(Patient $patient, PatientDTO $dto)
    {
        return $this->patientRepository->update($patient, $dto);
    }

    public function deletePatient(Patient $patient)
    {
        return $this->patientRepository->delete($patient);
    }
}
