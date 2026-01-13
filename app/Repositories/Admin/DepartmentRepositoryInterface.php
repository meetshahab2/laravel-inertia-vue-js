<?php

namespace App\Repositories\Admin;

use App\DTOs\DepartmentDTO;
use App\Models\Department;
use Illuminate\Support\Collection;

interface DepartmentRepositoryInterface
{
    public function all(): Collection;

    public function create(DepartmentDTO $dto): Department;

    public function update(Department $department, DepartmentDTO $dto): bool;

    public function delete(Department $department): bool;

    public function restore(int $id): bool;
}
