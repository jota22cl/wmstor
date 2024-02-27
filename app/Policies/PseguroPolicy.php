<?php

namespace App\Policies;

use App\Models\Pseguro;
use App\Models\User;
use Illuminate\Auth\Access\Response;

class PseguroPolicy
{
    /**
     * Determine whether the user can view any models.
     */
    public function viewAny(User $user): bool
    {
        return $user->can('Pseguro-Leer');
    }

    /**
     * Determine whether the user can view the model.
     */
    public function view(User $user, Pseguro $pseguro): bool
    {
        return $user->can('Pseguro-Leer');
    }

    /**
     * Determine whether the user can create models.
     */
    public function create(User $user): bool
    {
        return $user->can('Pseguro-Crear');
    }

    /**
     * Determine whether the user can update the model.
     */
    public function update(User $user, Pseguro $pseguro): bool
    {
        return $user->can('Pseguro-Actualizar');
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(User $user, Pseguro $pseguro): bool
    {
        return $user->can('Pseguro-Borrar');
    }

    /**
     * Determine whether the user can restore the model.
     */
    public function restore(User $user, Pseguro $pseguro): bool
    {
        //
    }

    /**
     * Determine whether the user can permanently delete the model.
     */
    public function forceDelete(User $user, Pseguro $pseguro): bool
    {
        //
    }
}
