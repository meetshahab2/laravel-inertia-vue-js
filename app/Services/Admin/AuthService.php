<?php
namespace App\Services\Admin;

use App\Repositories\Admin\AdminRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\ValidationException;

class AuthService
{
    protected AdminRepository $adminRepo;

    public function __construct(AdminRepository $adminRepo)
    {
        $this->adminRepo = $adminRepo;
    }

    public function login(Request $request): void
    {
        // if you use AdminLoginRequest, controller will already have validated input
        $credentials = $request->only('email','password');

        $admin = $this->adminRepo->findByEmail($credentials['email'] ?? '');

        if (! $admin || ! Auth::guard('admin')->attempt($credentials, $request->boolean('remember'))) {
            // throw ValidationException so Inertia gets 422 JSON
            throw ValidationException::withMessages(['general' => ['Invalid email or password.']]);
        }

        $request->session()->regenerate();
    }

    public function logout(Request $request): void
    {
        Auth::guard('admin')->logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
    }
}
