<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
    /**
     * Varios usuarios pueden tener el mismo rols
     * 
     * @return User[]
     */
    public function users()
    {
        return $this->hasMany(User::class);
    }
}
