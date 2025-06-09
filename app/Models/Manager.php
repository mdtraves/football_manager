<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Manager extends Model
{
    use HasFactory;

    protected $fillable = [
        'first_name',
        'middle_names',
        'sur_name',
        'team_id',
        'country_id',
        'height',
        'weight',
        'weekly_wage',
        'date_of_birth',
        'contract_end_date',
    ];

    public function team()
    {
        return $this->belongsTo(Team::class);
    }
    public function country()
    {
        return $this->belongsTo(Country::class);
    }
}
