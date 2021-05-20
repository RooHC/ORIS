<?php

namespace App\Policies;

use App\Presentacion;
use App\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class PresentacionPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can view any models.
     *
     * @param  \App\User  $user
     * @return mixed
     */
    public function viewAny(User $user)
    {
        //
    }

    /**
     * Determine whether the user can view the model.
     *
     * @param  \App\User  $user
     * @param  \App\Presentacion  $presentacion
     * @return mixed
     */
    public function view(User $user, Presentacion $presentacion)
    {
        return $user->id != $presentacion->user_id;
    }

    /**
     * Determine whether the user can create models.
     *
     * @param  \App\User  $user
     * @return mixed
     */
    public function create(User $user)
    {
        //
    }

    /**
     * Determine whether the user can update the model.
     *
     * @param  \App\User  $user
     * @param  \App\Presentacion  $presentacion
     * @return mixed
     */
    public function update(User $user, Presentacion $presentacion)
    {
        return $user->id == $presentacion->user_id;
    }

    /**
     * Determine whether the user can delete the model.
     *
     * @param  \App\User  $user
     * @param  \App\Presentacion  $presentacion
     * @return mixed
     */
    public function delete(User $user, Presentacion $presentacion)
    {
        return $user->id == $presentacion->user_id;
    }

    /**
     * Determine whether the user can restore the model.
     *
     * @param  \App\User  $user
     * @param  \App\Presentacion  $presentacion
     * @return mixed
     */
    public function restore(User $user, Presentacion $presentacion)
    {
        //
    }

    /**
     * Determine whether the user can permanently delete the model.
     *
     * @param  \App\User  $user
     * @param  \App\Presentacion  $presentacion
     * @return mixed
     */
    public function forceDelete(User $user, Presentacion $presentacion)
    {
        //
    }
}
