<?php

namespace App\Repositories\Admin;

use App\DTOs\DepartmentDTO;
use App\Models\Department;
use Illuminate\Support\Collection;

class DepartmentRepository implements DepartmentRepositoryInterface
{
    public function all(): Collection
    {
        return Department::latest()->get();
    }

    public function create(DepartmentDTO $dto): Department
    {
        return Department::create($dto->toArray());
    }

    public function update(Department $department, DepartmentDTO $dto): bool
    {
        return $department->update($dto->toArray());
    }

    public function delete(Department $department): bool
    {
        return (bool) $department->delete();
    }

    public function restore(int $id): bool
    {
        return (bool) Department::onlyTrashed()
            ->where('department_id', $id)
            ->restore();
    }
}
