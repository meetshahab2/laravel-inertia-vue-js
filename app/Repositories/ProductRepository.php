<?php

namespace App\Repositories;

use App\Models\Product;
use App\Models\ProductImage;

class ProductRepository
{
    protected $model;
    protected $imageModel;

    public function __construct(Product $model, ProductImage $imageModel)
    {
        $this->model = $model;
        $this->imageModel = $imageModel;
    }

    /**
     * Get all products.
     */
    public function all()
    {
        return $this->model
            ->with('images')
            ->orderBy('id', 'desc')
            ->get();
    }

    /**
     * Find a product by ID.
     */
    public function find($id)
    {
        return $this->model->find($id);
    }

    /**
     * Create a new product.
     */
    public function create(array $data)
    {
        return $this->model->create($data);
    }

    /**
     * Update an existing product.
     */
    public function update(Product $product, array $data)
    {
        $product->update($data);
        return $product;
    }

    /**
     * Delete a product.
     */
    public function delete(Product $product)
    {
        return $product->delete();
    }

    /**
     * Save multiple uploaded images.
     */
    public function saveImages(Product $product, array $images)
    {
        $paths = upload_multiple_images($images, 'products');

        foreach ($paths as $path) {
            $this->imageModel->create([
                'product_id' => $product->id,
                'path' => $path,
            ]);
        }

        return $product->load('images');
    }

    /**
     * Delete product images by IDs.
     */
    public function deleteImagesByIds(array $ids)
    {
        return $this->imageModel->whereIn('id', $ids)->delete();
    }

    /**
     * Add a single image to a product.
     */
    public function addImage(Product $product, string $path)
    {
        return $this->imageModel->create([
            'product_id' => $product->id,
            'path' => $path,
        ]);
    }
}
