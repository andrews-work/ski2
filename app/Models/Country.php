<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Country extends Model
{

    use HasFactory;

    protected $table = 'countries';
    protected $fillable = ['name', 'slug', 'continent_id'];

    public function continent()
    {
        return $this->belongsTo(Continent::class);
    }

    public function states()
    {
        return $this->hasMany(State::class);
    }

    public function resorts()
    {
        return $this->hasManyThrough(
            Resort::class,
            State::class,
            'country_id',
            'id',
            'town_id',
            'id'
        )->join('towns', 'resorts.town_id', '=', 'towns.id')
         ->join('states', 'towns.state_id', '=', 'states.id');
    }
}
