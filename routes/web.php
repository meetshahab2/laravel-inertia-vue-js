<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\CategoryController;



Route::get('/products', [ProductController::class, 'index'])->name('products.index');

// 🧭 Grouped Inertia CRUD Routes for Categories
Route::prefix('categories')->name('categories.')->group(function () {
    Route::get('/', [CategoryController::class, 'index'])->name('index');          // List
    Route::get('/create', [CategoryController::class, 'create'])->name('create');  // Form
    Route::post('/', [CategoryController::class, 'store'])->name('store');         // Save new
    Route::get('/{category}/edit', [CategoryController::class, 'edit'])->name('edit'); // Edit form
    Route::put('/{category}', [CategoryController::class, 'update'])->name('update');  // Update
    Route::delete('/{category}', [CategoryController::class, 'destroy'])->name('destroy'); // Delete
});