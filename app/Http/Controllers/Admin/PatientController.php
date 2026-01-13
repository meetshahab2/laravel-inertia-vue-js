<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Services\Admin\PatientService;
use App\Http\Requests\Admin\PatientRequest;
use App\Models\Patient;
use App\DTOs\PatientDTO;
use Inertia\Inertia;

class PatientController extends Controller
{
    protected $service;

    public function __construct(PatientService $service)
    {
        $this->service = $service;
    }

    public function index()
    {
        $patients = $this->service->getAllPatients();

        return Inertia::render('Admin/Patients/Index', [
            'patients' => $patients,
        ]);
    }

    public function create()
    {
        return Inertia::render('Admin/Patients/Create');
    }

    public function store(PatientRequest $request)
    {
        $this->service->createPatient(
            PatientDTO::fromRequest($request)
        );

        return redirect()
            ->route('admin.patients.index')
            ->with('success', 'Patient created successfully!');
    }


    public function edit(Patient $patient)
    {
        return Inertia::render('Admin/Patients/Edit', [
            'patient' => $patient,
        ]);
    }

    public function update(PatientRequest $request, Patient $patient)
    {
        $this->service->updatePatient(
            $patient,
            PatientDTO::fromRequest($request)
        );

        return redirect()
            ->route('admin.patients.index')
            ->with('success', 'Patient updated successfully!');
    }


    public function destroy(Patient $patient)
    {
        $this->service->deletePatient($patient);

        return redirect()
            ->route('admin.patients.index')
            ->with('success', 'Patient deleted successfully!');
    }
}
