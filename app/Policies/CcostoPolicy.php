<?php

namespace App\Policies;

use App\Models\Ccosto;
use App\Models\User;
use Illuminate\Auth\Access\Response;

class CcostoPolicy
{
    /**
     * Determine whether the user can view any models.
     */
    public function viewAny(User $user): bool
    {
        return $user->can('Ccosto-Leer');
    }

    /**
     * Determine whether the user can view the model.
     */
    public function view(User $user, Ccosto $ccosto): bool
    {
        return $user->can('Ccosto-Leer');
    }

    /**
     * Determine whether the user can create models.
     */
    public function create(User $user): bool
    {
        return $user->can('Ccosto-Crear');
    }

    /**
     * Determine whether the user can update the model.
     */
    public function update(User $user, Ccosto $ccosto): bool
    {
        return $user->can('Ccosto-Actualizar');
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(User $user, Ccosto $ccosto): bool
    {
        return $user->can('Ccosto-Borrar');
    }

    /**
     * Determine whether the user can restore the model.
     */
    public function restore(User $user, Ccosto $ccosto): bool
    {
        //
    }

    /**
     * Determine whether the user can permanently delete the model.
     */
    public function forceDelete(User $user, Ccosto $ccosto): bool
    {
        //
    }
}
