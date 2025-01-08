<?php

namespace App\Policies;

use App\Models\Numeral;
use App\Models\User;
use Illuminate\Auth\Access\Response;

class NumeralPolicy
{
    /**
     * Determine whether the user can view any models.
     */
    public function viewAny(User $user): bool
    {
        //
        return $user->can('Numeral-Leer');
    }

    /**
     * Determine whether the user can view the model.
     */
    public function view(User $user, Numeral $numeral): bool
    {
        //
        return $user->can('Numeral-Leer');
    }

    /**
     * Determine whether the user can create models.
     */
    public function create(User $user): bool
    {
        //
        return $user->can('Numeral-Creer');
    }

    /**
     * Determine whether the user can update the model.
     */
    public function update(User $user, Numeral $numeral): bool
    {
        //
        return $user->can('Numeral-Actualizar');
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(User $user, Numeral $numeral): bool
    {
        //
        return $user->can('Numeral-Borrar');
    }

    /**
     * Determine whether the user can restore the model.
     */
    public function restore(User $user, Numeral $numeral): bool
    {
        //
    }

    /**
     * Determine whether the user can permanently delete the model.
     */
    public function forceDelete(User $user, Numeral $numeral): bool
    {
        //
    }
}
