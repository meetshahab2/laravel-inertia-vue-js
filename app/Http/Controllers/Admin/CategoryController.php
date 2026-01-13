<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Services\Admin\CategoryService;
use App\Http\Requests\Admin\StoreCategoryRequest;
use App\Http\Requests\Admin\UpdateCategoryRequest;
use App\Models\Category;
use Illuminate\Http\Request;
use Inertia\Inertia;

class CategoryController extends Controller
{
    protected $service;

    public function __construct(CategoryService $service)
    {
        $this->service = $service;
    }

    /** 🧾 Show category list */
    public function index()
    {
        $categories = $this->service->getAllCategories();

        return Inertia::render('Admin/Categories/Index', [
            'categories' => $categories,
        ]);
    }

    /**  Create form */
    public function create()
    {
        return Inertia::render('Admin/Categories/Create');
    }

    /** Store new category */
    public function store(StoreCategoryRequest $request)
    {
        $this->service->createCategory($request);

        return redirect()
            ->route('admin.categories.index')
            ->with('success', 'Category created successfully!');
    }

    /** Edit category */
    public function edit(Category $category)
    {
        return Inertia::render('Admin/Categories/Edit', [
            'category' => $category,
        ]);
    }

    /** Update category */
    public function update(UpdateCategoryRequest $request, Category $category)
    {
        $this->service->updateCategory($category, $request);

       return redirect()
        ->route('admin.categories.index')
        ->with('success', 'Category updated successfully!');
    }

    /** Delete category */
    public function destroy(Category $category)
    {
        $this->service->deleteCategory($category);

        return redirect()
            ->route('admin.categories.index')
            ->with('success', 'Category deleted successfully!');
    }
}
