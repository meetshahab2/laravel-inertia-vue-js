<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return inertia('Welcome', [
        'appName' => config('app.name'),
    ]);
})->name('home');

