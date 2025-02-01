<?php

namespace App\Policies;

use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class MenuPolicy
{
    use HandlesAuthorization;

    public function viewAdminItems(User $user)
    {
        return $user->role_id === 1;
    }

    public function viewTccItems(User $user)
    {
        return in_array($user->role_id, [1, 2]); // Admin and Coordenador only
    }

    public function viewResumoItems(User $user)
    {
        return true; // Everyone can see resumos
    }

    public function viewOnlyResumos(User $user)
    {
        return $user->role_id === 3; // Only Aluno
    }
}
