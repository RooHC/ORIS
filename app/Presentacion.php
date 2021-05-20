<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Presentacion extends Model
{
    protected $guarded = [];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function preguntas()
    {
        return $this->hasMany(Pregunta::class);
    }

    public function opiniones()
    {
        return $this->hasMany(Opinion::class);
    }

    public static function boot() {
        parent::boot();

        static::deleting(function($presentacion) {
            $presentacion->preguntas()->delete();
        });
    }
}
