<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Services\Admin\SpecializationService;
use App\Http\Requests\Admin\SpecializationRequest;
use App\Models\Specialization;
use App\DTOs\SpecializationDTO;
use Inertia\Inertia;

class SpecializationController extends Controller
{
    protected $service;

    public function __construct(SpecializationService $service)
    {
        $this->service = $service;
    }

    /**
     * 📃 List Specializations
     */
    public function index()
    {
        $specializations = $this->service->getAll();

        return Inertia::render('Admin/Specializations/Index', [
            'specializations' => $specializations,
        ]);
    }

    /**
     * ➕ Create Page
     */
    public function create()
    {
        return Inertia::render('Admin/Specializations/Create');
    }

    /**
     * 💾 Store Specialization
     */
    public function store(SpecializationRequest $request)
    {
        $this->service->create(
            SpecializationDTO::fromRequest($request)
        );

        return redirect()
            ->route('admin.specializations.index')
            ->with('success', 'Specialization created successfully!');
    }

    /**
     * ✏️ Edit Page
     */
    public function edit(Specialization $specialization)
    {
        return Inertia::render('Admin/Specializations/Edit', [
            'specialization' => $specialization,
        ]);
    }

    /**
     * 🔄 Update Specialization
     */
    public function update(
        SpecializationRequest $request,
        Specialization $specialization
    ) {
        $this->service->update(
            $specialization,
            SpecializationDTO::fromRequest($request)
        );

        return redirect()
            ->route('admin.specializations.index')
            ->with('success', 'Specialization updated successfully!');
    }

    /**
     * 🗑 Delete (Status = 0 / Soft Delete logic)
     */
    public function destroy(Specialization $specialization)
    {
        $this->service->delete($specialization);

        return redirect()
            ->route('admin.specializations.index')
            ->with('success', 'Specialization deleted successfully!');
    }
}
