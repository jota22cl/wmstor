<?php

namespace App\Policies;

use App\Models\Ciudad;
use App\Models\User;
use Illuminate\Auth\Access\Response;

class CiudadPolicy
{
    /**
     * Determine whether the user can view any models.
     */
    public function viewAny(User $user): bool
    {
        return $user->can('Ciudad-Leer');
    }

    /**
     * Determine whether the user can view the model.
     */
    public function view(User $user, Ciudad $Ciudad): bool
    {
        return $user->can('Ciudad-Leer');
    }

    /**
     * Determine whether the user can create models.
     */
    public function create(User $user): bool
    {
        return $user->can('Ciudad-Crear');
    }

    /**
     * Determine whether the user can update the model.
     */
    public function update(User $user, Ciudad $Ciudad): bool
    {
        return $user->can('Ciudad-Actualizar');
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(User $user, Ciudad $Ciudad): bool
    {
        return $user->can('Ciudad-Borrar');
    }

    /**
     * Determine whether the user can restore the model.
     */
    public function restore(User $user, Ciudad $Ciudad): bool
    {
        //
    }

    /**
     * Determine whether the user can permanently delete the model.
     */
    public function forceDelete(User $user, Ciudad $Ciudad): bool
    {
        //
    }
}
