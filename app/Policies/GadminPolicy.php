<?php

namespace App\Policies;

use App\Models\Gadmin;
use App\Models\User;
use Illuminate\Auth\Access\Response;

class GadminPolicy
{
    /**
     * Determine whether the user can view any models.
     */
    public function viewAny(User $user): bool
    {
        return $user->can('Gadmin-Leer');
    }

    /**
     * Determine whether the user can view the model.
     */
    public function view(User $user, Gadmin $gadmin): bool
    {
        return $user->can('Gadmin-Leer');
    }

    /**
     * Determine whether the user can create models.
     */
    public function create(User $user): bool
    {
        return $user->can('Gadmin-Crear');
    }

    /**
     * Determine whether the user can update the model.
     */
    public function update(User $user, Gadmin $gadmin): bool
    {
        return $user->can('Gadmin-Actualizar');
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(User $user, Gadmin $gadmin): bool
    {
        return $user->can('Gadmin-Borrar');
    }

    /**
     * Determine whether the user can restore the model.
     */
    public function restore(User $user, Gadmin $gadmin): bool
    {
        //
    }

    /**
     * Determine whether the user can permanently delete the model.
     */
    public function forceDelete(User $user, Gadmin $gadmin): bool
    {
        //
    }
}
