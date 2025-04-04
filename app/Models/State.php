<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class State extends Model
{
    protected $table = 'states';
    protected $fillable = ['name', 'code', 'slug', 'country_id', 'timezone'];

    public function country()
    {
        return $this->belongsTo(Country::class);
    }

    public function towns()
    {
        return $this->hasMany(Town::class);
    }

    public function resorts()
    {
        return $this->hasManyThrough(Resort::class, Town::class);
    }

}
