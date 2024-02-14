<?php

namespace App\Policies;

use App\Models\Gcomun;
use App\Models\User;
use Illuminate\Auth\Access\Response;

class GcomunPolicy
{
    /**
     * Determine whether the user can view any models.
     */
    public function viewAny(User $user): bool
    {
        return $user->can('Gcomun-Leer');
    }

    /**
     * Determine whether the user can view the model.
     */
    public function view(User $user, Gcomun $gcomun): bool
    {
        return $user->can('Gcomun-Leer');
    }

    /**
     * Determine whether the user can create models.
     */
    public function create(User $user): bool
    {
        return $user->can('Gcomun-Crear');
    }

    /**
     * Determine whether the user can update the model.
     */
    public function update(User $user, Gcomun $gcomun): bool
    {
        return $user->can('Gcomun-Actualizar');
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(User $user, Gcomun $gcomun): bool
    {
        return $user->can('Gcomun-Borrar');
    }

    /**
     * Determine whether the user can restore the model.
     */
    public function restore(User $user, Gcomun $gcomun): bool
    {
        //
    }

    /**
     * Determine whether the user can permanently delete the model.
     */
    public function forceDelete(User $user, Gcomun $gcomun): bool
    {
        //
    }
}
