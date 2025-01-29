<?php

namespace App\Policies;

use App\Models\User;

class MenuPolicy
{
    public function viewAdminMenu(?User $user): bool
    {
        if (!$user) return false;
        return $user->isAdmin();
    }
}
