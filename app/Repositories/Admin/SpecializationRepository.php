<?php

namespace App\Repositories\Admin;

use App\DTOs\SpecializationDTO;
use App\Models\Specialization;
use Illuminate\Support\Collection;

class SpecializationRepository implements SpecializationRepositoryInterface
{
    /**
     * 📃 Get all specializations
     */
    public function all(): Collection
    {
        return Specialization::orderBy('specialization_id', 'desc')->get();
    }

    /**
     * 💾 Create specialization
     */
    public function create(SpecializationDTO $dto): Specialization
    {
        return Specialization::create([
            'specialization_name'        => $dto->specialization_name,
            'specialization_description' => $dto->specialization_description,
            'specialization_status'      => $dto->specialization_status,
        ]);
    }

    /**
     * 🔄 Update specialization
     */
    public function update(
        Specialization $specialization,
        SpecializationDTO $dto
    ): bool {
        return $specialization->update([
            'specialization_name'        => $dto->specialization_name,
            'specialization_description' => $dto->specialization_description,
            'specialization_status'      => $dto->specialization_status,
        ]);
    }

    /**
     * 🗑 Delete specialization (status-based delete)
     * 1 = active, 0 = inactive
     */
    public function delete(Specialization $specialization): bool
    {
        return $specialization->update([
            'specialization_status' => 0,
        ]);
    }

    /**
     * ♻ Restore specialization
     */
    public function restore(int $id): bool
    {
        return Specialization::where('specialization_id', $id)
            ->update(['specialization_status' => 1]);
    }
}
