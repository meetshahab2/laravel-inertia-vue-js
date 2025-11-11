<?php

namespace App\Services\Admin;

use App\Repositories\ProductRepository;
use App\Http\Requests\Admin\StoreProductRequest;
use App\Http\Requests\Admin\UpdateProductRequest;
use App\Models\Product;
use Illuminate\Support\Str;

class ProductService
{
    protected $repository;

    public function __construct(ProductRepository $repository)
    {
        $this->repository = $repository;
    }

    /**
     * Get all products.
     */
    public function getAllProducts()
    {
        return $this->repository->all();
    }

    /**
     * Get a single product by ID.
     */
    public function getProductById($id)
    {
        return $this->repository->find($id);
    }

    /**
     * Create a new product.
     */
    public function createProduct(StoreProductRequest $request)
    {

        $validated = $request->validated();
        $validated['slug'] = Str::slug($validated['name']);
        $product = $this->repository->create($validated);
        if ($request->hasFile('images')) {
            $this->repository->saveImages($product, $request->file('images'));
        }
        return $product;
    }

    /**
     * Update a product.
     */
    public function updateProduct(Product $product, UpdateProductRequest $request)
    {
        $data = $request->validated();
        
        $data['slug'] = Str::slug($data['name']);

        $this->repository->update($product, $data);

        if (!empty($data['remove_images'])) {
            $this->repository->deleteImagesByIds($data['remove_images']);
        }

        if (!empty($data['images'])) {
            foreach ($data['images'] as $image) {
                $path = $image->store('products', 'public');
                $this->repository->addImage($product, $path);
            }
        }

        return $product;
    }

    /**
     * Delete a product.
     */
    public function deleteProduct(Product $product)
    {
        return $this->repository->delete($product);
    }
}
