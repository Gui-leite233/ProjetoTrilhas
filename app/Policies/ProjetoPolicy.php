<?php

namespace App\Policies;

use App\Models\Projeto;
use App\Models\User;
use Illuminate\Auth\Access\Response;

class ProjetoPolicy
{
    /**
     * Determine whether the user can view any models.
     */
    public function viewAny(User $user): bool
    {
        return true; // Todos usuários autenticados podem ver a lista
    }

    /**
     * Determine whether the user can view the model.
     */
    public function view(User $user, Projeto $projeto): bool
    {
        // Apenas o criador e usuários associados podem ver o projeto
        return $user->id === $projeto->user_id || 
               $projeto->users->contains($user->id);
    }

    /**
     * Determine whether the user can create models.
     */
    public function create(User $user): bool
    {
        // Apenas admins podem criar projetos
        return $user->role->name === 'Admin';
    }

    /**
     * Determine whether the user can update the model.
     */
    public function update(User $user, Projeto $projeto): bool
    {
        // Apenas o criador pode editar
        return $user->id === $projeto->user_id;
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(User $user, Projeto $projeto): bool
    {
        // Apenas o criador pode deletar
        return $user->id === $projeto->user_id;
    }

    /**
     * Determine whether the user can restore the model.
     */
    public function restore(User $user, Projeto $projeto): bool
    {
        return false;
    }

    /**
     * Determine whether the user can permanently delete the model.
     */
    public function forceDelete(User $user, Projeto $projeto): bool
    {
        return false;
    }
}
