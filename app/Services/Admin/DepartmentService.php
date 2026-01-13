<?php

namespace App\Services\Admin;

use App\DTOs\DepartmentDTO;
use App\Models\Department;
use App\Repositories\Admin\DepartmentRepositoryInterface;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;

class DepartmentService
{
    public function __construct(
        protected DepartmentRepositoryInterface $repository
    ) {}

    public function getAll(): Collection
    {
        return $repository = $this->repository->all();
    }

    public function create(DepartmentDTO $dto): Department
    {
        return DB::transaction(function () use ($dto) {
            return $this->repository->create($dto);
        });
    }

    public function update(Department $department, DepartmentDTO $dto): bool
    {
        return DB::transaction(function () use ($department, $dto) {
            return $this->repository->update($department, $dto);
        });
    }

    public function delete(Department $department): bool
    {
        return $this->repository->delete($department);
    }

    public function restore(int $id): bool
    {
        return $this->repository->restore($id);
    }
}
