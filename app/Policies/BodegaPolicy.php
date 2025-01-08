<?php

namespace App\Policies;

use App\Models\Bodega;
use App\Models\User;
use Illuminate\Auth\Access\Response;

class BodegaPolicy
{
    /**
     * Determine whether the user can view any models.
     */
    public function viewAny(User $user): bool
    {
        return $user->can('Servicio-Leer');
    }

    /**
     * Determine whether the user can view the model.
     */
    public function view(User $user, Bodega $bodega): bool
    {
        return $user->can('Servicio-Leer');
    }

    /**
     * Determine whether the user can create models.
     */
    public function create(User $user): bool
    {
        return $user->can('Servicio-Crear');
    }

    /**
     * Determine whether the user can update the model.
     */
    public function update(User $user, Bodega $bodega): bool
    {
        return $user->can('Servicio-Actualizar');
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(User $user, Bodega $bodega): bool
    {
        return $user->can('Servicio-Borrar');
    }

    /**
     * Determine whether the user can restore the model.
     */
    public function restore(User $user, Bodega $bodega): bool
    {
        //
    }

    /**
     * Determine whether the user can permanently delete the model.
     */
    public function forceDelete(User $user, Bodega $bodega): bool
    {
        //
    }
}
