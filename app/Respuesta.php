<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Respuesta extends Model
{
    /**
     * La respuesta siempre pertenece a un usuario
     * 
     * @return User
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * La respuesta siempre pertenece a una pregunta
     * 
     * @return Pregunta
     */
    public function pregunta()
    {
        return $this->belongsTo(Pregunta::class);
    }
}
