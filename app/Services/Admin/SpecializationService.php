<?php

namespace App\Services\Admin;

use App\DTOs\SpecializationDTO;
use App\Models\Specialization;
use App\Repositories\Admin\SpecializationRepositoryInterface;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;

class SpecializationService
{
    public function __construct(
        protected SpecializationRepositoryInterface $repository
    ) {}

    public function getAll(): Collection
    {
        return $this->repository->all();
    }

    public function create(SpecializationDTO $dto): Specialization
    {
        return DB::transaction(function () use ($dto) {
            return $this->repository->create($dto);
        });
    }
    
    public function update(
        Specialization $specialization,
        SpecializationDTO $dto
    ): bool {
        return DB::transaction(function () use ($specialization, $dto) {
            return $this->repository->update($specialization, $dto);
        });
    }

    public function delete(Specialization $specialization): bool
    {
        return $this->repository->delete($specialization);
    }

    public function restore(int $id): bool
    {
        return $this->repository->restore($id);
    }
}
