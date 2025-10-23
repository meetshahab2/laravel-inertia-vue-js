<?php

namespace App\Http\Controllers;

use Inertia\Inertia;

class ProductController extends Controller
{
    public function index()
    {
        // Example dynamic data (could be from DB)
        $products = [
          
        ];



        return Inertia::render('Products/Index', [
            'products' => $products
        ]);
    }
}
