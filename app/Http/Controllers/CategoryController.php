<?php

namespace App\Http\Controllers;

use Inertia\Inertia;

class CategoryController extends Controller
{
    public function index()
    {
        $categories = [
            ['id' => 1, 'name' => 'Electronics'],
            ['id' => 2, 'name' => 'Accessories'],
            ['id' => 3, 'name' => 'Furniture'],
        ];

        return Inertia::render('Categories/Index', [
            'categories' => $categories
        ]);
    }
}
