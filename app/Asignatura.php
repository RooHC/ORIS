<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Asignatura extends Model
{
    protected $guarded = [];

    public function presentaciones()
    {
        return $this->hasMany(Presentacion::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function suscriptores()
    {
        return $this->belongsToMany(User::class);
    }
}
