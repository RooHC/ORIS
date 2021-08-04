<?php

namespace App\Policies;

use App\Pregunta;
use App\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class PreguntaPolicy
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
     * @param  \App\Pregunta  $pregunta
     * @return mixed
     */
    public function view(User $user, Pregunta $pregunta)
    {
        if (count($pregunta->respuestas) == 0) {
            return true;
        }
        foreach ($pregunta->respuestas as $respuesta) {
            if ($user->id == $respuesta->user_id) {
                return false;
            }
        }
        return true;
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
     * @param  \App\Pregunta  $pregunta
     * @return mixed
     */
    public function update(User $user, Pregunta $pregunta)
    {
        return $user->id == $pregunta->presentacion->user_id;
    }

    /**
     * Determine whether the user can delete the model.
     *
     * @param  \App\User  $user
     * @param  \App\Pregunta  $pregunta
     * @return mixed
     */
    public function delete(User $user, Pregunta $pregunta)
    {
        return $user->id == $pregunta->presentacion->user_id;
    }

    /**
     * Determine whether the user can restore the model.
     *
     * @param  \App\User  $user
     * @param  \App\Pregunta  $pregunta
     * @return mixed
     */
    public function restore(User $user, Pregunta $pregunta)
    {
        //
    }

    /**
     * Determine whether the user can permanently delete the model.
     *
     * @param  \App\User  $user
     * @param  \App\Pregunta  $pregunta
     * @return mixed
     */
    public function forceDelete(User $user, Pregunta $pregunta)
    {
        //
    }
}
