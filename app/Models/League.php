<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class League extends Model
{

    protected $fillable = [
        'name',
        'country_id',
        'level'
    ];

    public function country()
    {
        return $this->belongsTo(Country::class);
    }

      public function teams()
    {
        return $this->hasMany(Team::class);
    }
}
