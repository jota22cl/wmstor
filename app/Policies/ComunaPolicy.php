<?php

namespace App\Policies;

use App\Models\Comuna;
use App\Models\User;
use Illuminate\Auth\Access\Response;

class ComunaPolicy
{
    /**
     * Determine whether the user can view any models.
     */
    public function viewAny(User $user): bool
    {
        return $user->can('Comuna-Leer');
    }

    /**
     * Determine whether the user can view the model.
     */
    public function view(User $user, Comuna $Comuna): bool
    {
        return $user->can('Comuna-Leer');
    }

    /**
     * Determine whether the user can create models.
     */
    public function create(User $user): bool
    {
        return $user->can('Comuna-Crear');
    }

    /**
     * Determine whether the user can update the model.
     */
    public function update(User $user, Comuna $Comuna): bool
    {
        return $user->can('Comuna-Actualizar');
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(User $user, Comuna $Comuna): bool
    {
        return $user->can('Comuna-Borrar');
    }

    /**
     * Determine whether the user can restore the model.
     */
    public function restore(User $user, Comuna $comuna): bool
    {
        //
    }

    /**
     * Determine whether the user can permanently delete the model.
     */
    public function forceDelete(User $user, Comuna $comuna): bool
    {
        //
    }
}
