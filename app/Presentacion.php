<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Presentacion extends Model
{
    protected $guarded = [];

    /**
     * La presentación siempre pertenece a un usuario
     * 
     * @return User
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Una presentación puede tener preguntas asociadas
     * 
     * @return Pregunta[]
     */
    public function preguntas()
    {
        return $this->hasMany(Pregunta::class);
    }

    /**
     * Una presentación puede tener opiniones asociadas
     * 
     * @return Opinion[]
     */
    public function opiniones()
    {
        return $this->hasMany(Opinion::class);
    }

    /**
     * La presentación siempre va a pertenecer a una asignatura
     * 
     * @return Asignatura
     */
    public function asignatura()
    {
        return $this->belongsTo(Asignatura::class);
    }

    /**
     * En caso de borrar una presentación, se borrarán también las preguntas asociadas
     */
    public static function boot()
    {
        parent::boot();

        static::deleting(function ($presentacion) {
            $presentacion->preguntas()->delete();
        });
    }
}
