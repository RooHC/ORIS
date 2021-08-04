<?php

namespace App\Policies;

use App\Asignatura;
use App\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class AsignaturaPolicy
{
    use HandlesAuthorization;

    /**
     * Create a new policy instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Determine whether the user can create models.
     *
     * @param  \App\User  $user
     * @return mixed
     */
    public function create(User $user)
    {
        return $user->role_id == 1;
    }

    /**
     * Determine whether the user can view the model.
     *
     * @param  \App\User  $user
     * @param  \App\Asignatura  $asignatura
     * @return mixed
     */
    public function view(User $user, Asignatura $asignatura)
    {
        return $user->id == $asignatura->user_id;
    }
}
