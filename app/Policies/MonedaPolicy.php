<?php

namespace App\Policies;

use App\Models\Moneda;
use App\Models\User;
use Illuminate\Auth\Access\Response;

class MonedaPolicy
{
    /**
     * Determine whether the user can view any models.
     */
    public function viewAny(User $user): bool
    {
        //return $user->hasPermissionTo('Moneda-Leer');
        return $user->can('Moneda-Leer');
    }

    /**
     * Determine whether the user can view the model.
     */
    public function view(User $user, Moneda $moneda): bool
    {
        //return $user->hasPermissionTo('Moneda-Leer');
        return $user->can('Moneda-Leer');
    }

    /**
     * Determine whether the user can create models.
     */
    public function create(User $user): bool
    {
        //return $user->hasPermissionTo('Moneda-Crear');
        return $user->can('Moneda-Crear');
    }

    /**
     * Determine whether the user can update the model.
     */
    public function update(User $user, Moneda $moneda): bool
    {
        //return $user->hasPermissionTo('Moneda-Actualizar');
        return $user->can('Moneda-Actualizar');
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(User $user, Moneda $moneda): bool
    {
        //return $user->hasPermissionTo('Moneda-Borrar');
        return $user->can('Moneda-Borrar');
    }

    /**
     * Determine whether the user can restore the model.
     */
    public function restore(User $user, Moneda $moneda): bool
    {
        //
    }

    /**
     * Determine whether the user can permanently delete the model.
     */
    public function forceDelete(User $user, Moneda $moneda): bool
    {
        //
    }
}
