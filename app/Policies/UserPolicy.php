<?php

namespace App\Policies;

use App\Models\User;

class UserPolicy
{
    public function isAdmin(User $user): bool
    {
        return $user->role_id === 1;
    }
}