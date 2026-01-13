<?php

namespace App\Repositories\Admin;

use App\Models\Patient;
use App\DTOs\PatientDTO;
use Illuminate\Support\Collection;

interface PatientRepositoryInterface
{
    public function all(): Collection;

    public function findById(int $id): ?Patient;

    public function create(PatientDTO $dto): Patient;

    public function update(Patient $patient, PatientDTO $dto): Patient;

    public function delete(Patient $patient): bool;
}
