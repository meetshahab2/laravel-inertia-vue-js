<?php

namespace App\Repositories\Admin;

use App\DTOs\SpecializationDTO;
use App\Models\Specialization;
use Illuminate\Support\Collection;

interface SpecializationRepositoryInterface
{
    public function all(): Collection;

    public function create(SpecializationDTO $dto): Specialization;

    public function update(
        Specialization $specialization,
        SpecializationDTO $dto
    ): bool;

    public function delete(Specialization $specialization): bool;

    public function restore(int $id): bool;
}
