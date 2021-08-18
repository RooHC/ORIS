<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Pregunta extends Model
{
    protected $guarded = [];

    /**
     * Una pregunta siempre pertenece a una presentación
     * 
     * @return Presentacion
     */
    public function presentacion()
    {
        return $this->belongsTo(Presentacion::class);
    }

    /**
     * Una pregunta puede tener respuestas asociadas
     * 
     * @return Respuesta[]
     */
    public function respuestas()
    {
        return $this->hasMany(Respuesta::class);
    }
}
