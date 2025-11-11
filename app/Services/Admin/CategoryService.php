<?php

namespace App\Services\Admin;

use App\Repositories\CategoryRepository;
use App\Models\Category;
use App\Http\Requests\Admin\StoreCategoryRequest;
use App\Http\Requests\Admin\UpdateCategoryRequest;
use Illuminate\Support\Str;

class CategoryService
{
    protected $repository;

    public function __construct(CategoryRepository $repository)
    {
        $this->repository = $repository;
    }

    /** 🧾 Get all categories */
    public function getAllCategories()
    {
        return $this->repository->all();
    }

    /** 🔍 Get category by ID */
    public function getCategoryById($id)
    {
        return $this->repository->find($id);
    }

    /** ➕ Create a new category */
    public function createCategory(StoreCategoryRequest $request)
    {
        $data = $request->validated();
        $data['slug'] = Str::slug($data['name']);

        return $this->repository->create($data);
    }

    /** ✏️ Update an existing category */
    public function updateCategory(Category $category, UpdateCategoryRequest $request)
    {
        $data = $request->validated();
        $data['slug'] = Str::slug($data['name']);

        return $this->repository->update($category, $data);
    }

    /** 🗑️ Delete a category */
    public function deleteCategory(Category $category)
    {
        return $this->repository->delete($category);
    }
}
