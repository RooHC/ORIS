<?php

namespace App;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'role_id', 'name', 'email', 'password', 'google_id',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    /**
     * Cada usuario tendrá un sol asociado
     * 
     * @return Role
     */
    public function role()
    {
        return $this->belongsTo(Role::class);
    }

    /**
     * Cada usuario puede subir presentaciones
     * 
     * @return Presentacion[]
     */
    public function presentaciones()
    {
        return $this->hasMany(Presentacion::class)->orderBy('created_at', 'DESC');
    }

    /**
     * Los usuarios con rol profesor pueden crear asignaturas
     * 
     * @return Asignatura[]
     */
    public function asignaturas()
    {
        return $this->hasMany(Asignatura::class);
    }

    /**
     * Cada usuario puede añadir preguntas relacionadas con una presentación
     * 
     * @return Pregunta[]
     */
    public function preguntas()
    {
        return $this->hasMany(Pregunta::class);
    }

    /**
     * Los usuarios pueden añadir opiniones relacionadas con una presentación
     * 
     * @return Opinion[]
     */
    public function opinion()
    {
        return $this->hasMany(Opinion::class);
    }

    /**
     * Los usuarios pueden dar like a los comentarios
     * 
     * @return Like[]
     */
    public function likes()
    {
        return $this->hasMany(Like::class);
    }

    /**
     * Los usuarios con rol alumno pueden suscribirse a las asignaturas
     * 
     * @return Asignatura[]
     */
    public function suscrito()
    {
        return $this->belongsToMany(Asignatura::class);
    }
}
