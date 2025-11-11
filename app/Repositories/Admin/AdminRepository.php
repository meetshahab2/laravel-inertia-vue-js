<?php

namespace App\Repositories\Admin;

use App\Models\Admin;

class AdminRepository
{
    /**
     * Find admin by email.
     */
    public function findByEmail(string $email): ?Admin
    {
        return Admin::where('email', $email)->first();
    }
}
