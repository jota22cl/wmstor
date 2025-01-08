<?php

namespace App\Policies;

use App\Models\User;
use App\Models\Valorservicio;
use Illuminate\Auth\Access\Response;

class ValorservicioPolicy
{
    /**
     * Determine whether the user can view any models.
     */
    public function viewAny(User $user): bool
    {
        //
        return $user->can('Valservicio-Leer');
    }

    /**
     * Determine whether the user can view the model.
     */
    public function view(User $user, Valorservicio $valorservicio): bool
    {
        //
        return $user->can('Valservicio-Leer');
    }

    /**
     * Determine whether the user can create models.
     */
    public function create(User $user): bool
    {
        //
        return $user->can('Valservicio-Crear');
    }

    /**
     * Determine whether the user can update the model.
     */
    public function update(User $user, Valorservicio $valorservicio): bool
    {
        //
        return $user->can('Valservicio-Actualizar');
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(User $user, Valorservicio $valorservicio): bool
    {
        //
        return $user->can('Valservicio-Borrar');
    }

    /**
     * Determine whether the user can restore the model.
     */
    public function restore(User $user, Valorservicio $valorservicio): bool
    {
        //
    }

    /**
     * Determine whether the user can permanently delete the model.
     */
    public function forceDelete(User $user, Valorservicio $valorservicio): bool
    {
        //
    }
}
