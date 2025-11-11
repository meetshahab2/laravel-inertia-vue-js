<?php

namespace App\Http\Controllers\Admin\Auth;

use App\Http\Controllers\Controller;
use App\Services\Admin\AuthService;
use Illuminate\Http\Request;
use Inertia\Inertia;
use App\Http\Requests\AdminLoginRequest;
use Illuminate\Http\RedirectResponse;


class LoginController extends Controller
{
    protected AuthService $authService;

    public function __construct(AuthService $authService)
    {
        $this->authService = $authService;
    }

    public function showLoginForm()
    {
        return Inertia::render('Admin/Login');
    }

    public function login(AdminLoginRequest $request): RedirectResponse
    {
        // AdminLoginRequest already validated; let exceptions bubble for Inertia
        $this->authService->login($request);
        return redirect()->intended('/admin/dashboard');
    }

    public function logout(Request $request)
    {
        $this->authService->logout($request);
        return redirect()->route('admin.login');
    }
}
