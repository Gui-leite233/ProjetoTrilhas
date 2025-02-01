<?php

namespace App\Policies;

use App\Models\User;
use App\Models\Resumo;
use Illuminate\Auth\Access\HandlesAuthorization;

class ResumoPolicy
{
    use HandlesAuthorization;

    public function manage(User $user, Resumo $resumo)
    {
        // Admin (role_id = 1) or Coordinator (role_id = 2) can manage all resumos
        if (in_array($user->role_id, [1, 2])) {
            return true;
        }

        // Regular users can only manage resumos they're assigned to
        return $resumo->users->contains($user->id);
    }

    public function viewCount(User $user)
    {
        // Admin and Coordinator can see all counts
        if (in_array($user->role_id, [1, 2])) {
            return true;
        }

        // Regular users can only see their own count
        return $user->role_id === 3;
    }

    public function viewAllCounts(User $user)
    {
        // Only Admin and Coordinator can see all users' counts
        return in_array($user->role_id, [1, 2]);
    }
}
