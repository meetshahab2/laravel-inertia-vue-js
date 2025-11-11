<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AdminAuthMiddleware
{
    /**
     * Handle an incoming request.
     */
    public function handle(Request $request, Closure $next)
    {
        // 🚫 If admin not logged in, redirect to admin login page
        if (!Auth::guard('admin')->check()) {
            return redirect()->route('admin.login');
        }

        // ✅ If admin is logged in and trying to access login page again
        if ($request->routeIs('admin.login') && Auth::guard('admin')->check()) {
            return redirect()->route('admin.dashboard');
        }

        // Continue to the requested route
        return $next($request);
    }
}
