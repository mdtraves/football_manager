<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;


class Country extends Model
{

        use HasFactory;

    public function leagues()
    {
        return $this->hasMany(League::class);
    }

          public function team()
    {
        return $this->hasMany(Team::class);
    }
}
