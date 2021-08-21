<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Asignatura extends Model
{
    protected $guarded = [];

    /**
     * Una asignatura tendrá asociadas presentaciones
     * 
     * @return Presentacion[]
     */
    public function presentaciones()
    {
        return $this->hasMany(Presentacion::class);
    }

    /**
     * La asignatura pertenecerá a un profesor
     * 
     * @return User
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * La asignatura tendrá unos alumnos suscritos
     * 
     * @return User[]
     */
    public function suscriptores()
    {
        return $this->belongsToMany(User::class)->orderBy('name');
    }
}
