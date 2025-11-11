<?php

use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;

use App\Http\Middleware\HandleInertiaRequests;
use App\Http\Middleware\AdminAuthMiddleware;

return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        web: [
            __DIR__ . '/../routes/web.php',
            __DIR__ . '/../routes/admin.php', // ✅ include admin routes
        ],
        commands: __DIR__ . '/../routes/console.php',
        health: '/up',
    )
    ->withMiddleware(function (Middleware $middleware) {
        // 🧩 Add default Inertia middleware
        $middleware->web(append: [
            HandleInertiaRequests::class,
        ]);

        // 🧱 Custom middleware aliases
        $middleware->alias([
            'admin.auth' => AdminAuthMiddleware::class,
        ]);
    })
    ->withExceptions(function (Exceptions $exceptions) {
        //
    })
    ->create();
