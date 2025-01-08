<?php

namespace App\Policies;

use App\Models\Tipoconstruccion;
use App\Models\User;
use Illuminate\Auth\Access\Response;

class TipoconstruccionPolicy
{
    /**
     * Determine whether the user can view any models.
     */
    public function viewAny(User $user): bool
    {
        return $user->can('TipoContruc-Leer');
    }

    /**
     * Determine whether the user can view the model.
     */
    public function view(User $user, Tipoconstruccion $tipoconstruccion): bool
    {
        return $user->can('TipoContruc-Leer');
    }

    /**
     * Determine whether the user can create models.
     */
    public function create(User $user): bool
    {
        return $user->can('TipoContruc-Crear');
    }

    /**
     * Determine whether the user can update the model.
     */
    public function update(User $user, Tipoconstruccion $tipoconstruccion): bool
    {
        return $user->can('TipoContruc-Actualizar');
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(User $user, Tipoconstruccion $tipoconstruccion): bool
    {
        return $user->can('TipoContruc-Borrar');
    }

    /**
     * Determine whether the user can restore the model.
     */
    public function restore(User $user, Tipoconstruccion $tipoconstruccion): bool
    {
        //
    }

    /**
     * Determine whether the user can permanently delete the model.
     */
    public function forceDelete(User $user, Tipoconstruccion $tipoconstruccion): bool
    {
        //
    }
}
