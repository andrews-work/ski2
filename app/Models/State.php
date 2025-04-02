<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class State extends Model
{
    protected $table = '';
    protected $fillable = ['name', 'code', 'country_id'];

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
