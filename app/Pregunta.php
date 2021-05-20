<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Pregunta extends Model
{
    protected $guarded = [];

    public function presentacion()
    {
        return $this->belongsTo(Presentacion::class);
    }

    public function respuestas()
    {
        return $this->hasMany(Respuesta::class);
    }
}
