<?php

namespace App\Policies;

use App\Models\Unimedida;
use App\Models\User;
use Illuminate\Auth\Access\Response;

class UnimedidaPolicy
{
    /**
     * Determine whether the user can view any models.
     */
    public function viewAny(User $user): bool
    {
        return $user->can('Unimed-Leer');
    }

    /**
     * Determine whether the user can view the model.
     */
    public function view(User $user, Unimedida $unimedida): bool
    {
        return $user->can('Unimed-Leer');
    }

    /**
     * Determine whether the user can create models.
     */
    public function create(User $user): bool
    {
        return $user->can('Unimed-Crear');
    }

    /**
     * Determine whether the user can update the model.
     */
    public function update(User $user, Unimedida $unimedida): bool
    {
        return $user->can('Unimed-Actualizar');
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(User $user, Unimedida $unimedida): bool
    {
        return $user->can('Unimed-Borrar');
    }

    /**
     * Determine whether the user can restore the model.
     */
    public function restore(User $user, Unimedida $unimedida): bool
    {
        //
    }

    /**
     * Determine whether the user can permanently delete the model.
     */
    public function forceDelete(User $user, Unimedida $unimedida): bool
    {
        //
    }
}
