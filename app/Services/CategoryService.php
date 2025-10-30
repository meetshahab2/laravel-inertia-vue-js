<?php

namespace App\Services;

use App\Repositories\CategoryRepository;
use App\Models\Category;

class CategoryService
{
    protected $repository;

    public function __construct(CategoryRepository $repository)
    {
        $this->repository = $repository;
    }

    public function getAllCategories()
    {
        return $this->repository->all();
    }

    public function getCategoryById($id)
    {
        return $this->repository->find($id);
    }

    public function createCategory(array $data)
    {
        return $this->repository->create($data);
    }

    public function updateCategory(Category $category, array $data)
    {
        return $this->repository->update($category, $data);
    }

    public function deleteCategory(Category $category)
    {
        return $this->repository->delete($category);
    }
}
