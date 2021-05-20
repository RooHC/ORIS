<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Opinion extends Model
{
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function presentacion()
    {
        return $this->belongsTo(Presentacion::class);
    }

    public function likes()
    {
        return $this->hasMany(Like::class);
    }

    public function likedBy(User $user)
    {
        return $this->likes->contains('user_id', $user->id);
    }
}
