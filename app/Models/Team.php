<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Team extends Model
{

    protected $fillable = [
        'name',
        'country_id',
        'league_id',
        'overall_rating',
    ];
    public function league()
    {
        return $this->belongsTo(League::class);
    }

    public function country()
    {
        return $this->belongsTo(Country::class);
    }

    public function players()
    {
        return $this->hasMany(Player::class);
    }

     public function manager()
    {
        return $this->hasOne(Manager::class);
    }

}
