<?php

namespace App\Http\Controllers\Admin;

use App\DTOs\DepartmentDTO;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\DepartmentRequest;
use App\Models\Department;
use App\Services\Admin\DepartmentService;
use Inertia\Inertia;

class DepartmentController extends Controller
{
    public function __construct(
        protected DepartmentService $service
    ) {}

    public function index()
    {
        return Inertia::render('Admin/Departments/Index', [
            'departments' => $this->service->getAll(),
        ]);
    }

    public function create()
    {
        return Inertia::render('Admin/Departments/Create');
    }

    public function store(DepartmentRequest $request)
    {
        $this->service->create(
            DepartmentDTO::fromRequest($request)
        );

        return redirect()
            ->route('admin.departments.index')
            ->with('success', 'Department created successfully');
    }

    public function edit(Department $department)
    {
        return Inertia::render('Admin/Departments/Edit', [
            'department' => $department,
        ]);
    }

    public function update(DepartmentRequest $request, Department $department)
    {
        $this->service->update(
            $department,
            DepartmentDTO::fromRequest($request)
        );

        return redirect()
            ->route('admin.departments.index')
            ->with('success', 'Department updated successfully');
    }

    public function destroy(Department $department)
    {
        $this->service->delete($department);

        return redirect()
            ->route('admin.departments.index')
            ->with('success', 'Department deleted successfully');
    }

    public function restore($id)
    {
        $this->service->restore($id);

        return redirect()
            ->route('admin.departments.index')
            ->with('success', 'Department restored successfully');
    }
}
