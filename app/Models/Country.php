<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Country extends Model
{
    public function leagues()
    {
        return $this->hasMany(League::class);
    }

          public function team()
    {
        return $this->hasMany(Team::class);
    }
}
