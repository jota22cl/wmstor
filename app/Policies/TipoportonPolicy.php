<?php

namespace App\Policies;

use App\Models\Tipoporton;
use App\Models\User;
use Illuminate\Auth\Access\Response;

class TipoportonPolicy
{
    /**
     * Determine whether the user can view any models.
     */
    public function viewAny(User $user): bool
    {
        return $user->can('TipoPorton-Leer');
    }

    /**
     * Determine whether the user can view the model.
     */
    public function view(User $user, Tipoporton $tipoporton): bool
    {
        return $user->can('TipoPorton-Leer');
    }

    /**
     * Determine whether the user can create models.
     */
    public function create(User $user): bool
    {
        return $user->can('TipoPorton-Crear');
    }

    /**
     * Determine whether the user can update the model.
     */
    public function update(User $user, Tipoporton $tipoporton): bool
    {
        return $user->can('TipoPorton-Actualizar');
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(User $user, Tipoporton $tipoporton): bool
    {
        return $user->can('TipoPorton-Borrar');
    }

    /**
     * Determine whether the user can restore the model.
     */
    public function restore(User $user, Tipoporton $tipoporton): bool
    {
        //
    }

    /**
     * Determine whether the user can permanently delete the model.
     */
    public function forceDelete(User $user, Tipoporton $tipoporton): bool
    {
        //
    }
}
