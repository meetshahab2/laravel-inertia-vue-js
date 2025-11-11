<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Services\Admin\ProductService;
use App\Http\Requests\Admin\StoreProductRequest;
use App\Http\Requests\Admin\UpdateProductRequest;
use App\Models\Product;
use Inertia\Inertia;
use App\Services\Admin\CategoryService;
use Illuminate\Support\Facades\Log;

class ProductController extends Controller
{
    protected $service;
    protected $categoryService;

    public function __construct(ProductService $service, CategoryService $categoryService)
    {
        $this->service = $service;
        $this->categoryService = $categoryService;
    }

    /**
     * Display a listing of products.
     */
    public function index()
    {
        $products = $this->service->getAllProducts();

        return Inertia::render('Admin/Products/Index', [
            'products' => $products
        ]);
    }

    /**
     * Show the form for creating a new product.
     */
    public function create()
    {
        $categories = $this->categoryService->getAllCategories();

        return Inertia::render('Admin/Products/Create', [
            'categories' => $categories,
        ]);
    }

    /**
     * Store a newly created product.
     */
    public function store(StoreProductRequest $request)
    {
        $this->service->createProduct($request);

        return redirect()
            ->route('admin.products.index')
            ->with('success', 'Product created successfully!');
    }

    /**
     * Show the form for editing a product.
     */
    public function edit(Product $product)
    {
        $product->load('images');
        $categories = $this->categoryService->getAllCategories();

        // ✅ Add URL field to each image
        $product->images->transform(function ($image) {
            $image->url = asset('storage/' . $image->path);
            return $image;
        });

        return Inertia::render('Admin/Products/Edit', [
            'product' => $product,
            'categories' => $categories,
        ]);
    }

    /**
     * Update a product.
     */
    public function update(UpdateProductRequest $request, Product $product)
    {
        $this->service->updateProduct($product, $request);

        return redirect()
            ->route('admin.products.index')
            ->with('success', '✅ Product updated successfully!');
    }

    /**
     * Remove a product.
     */
    public function destroy(Product $product)
    {
        $this->service->deleteProduct($product);

        return redirect()->route('admin.products.index')
                         ->with('success', 'Product deleted successfully!');
    }
}
