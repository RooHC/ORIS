<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Opinion extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'visible'
    ];

    /**
     * Una opinión pertenece siempre a un usuario
     * 
     * @return User
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Una opinión estará asociada a una presentación
     * 
     * @return Presentacion
     */
    public function presentacion()
    {
        return $this->belongsTo(Presentacion::class);
    }

    /**
     * Una opinion puede tener asociados unos likes
     * 
     * @return Like[]
     */
    public function likes()
    {
        return $this->hasMany(Like::class);
    }


    /**
     * Se conocerá quien ha dado like a un comentario
     * 
     * @return User
     */
    public function likedBy(User $user)
    {
        return $this->likes->contains('user_id', $user->id);
    }
}
