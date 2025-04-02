<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Town extends Model
{
    protected $table = '';
    protected $fillable = ['name', 'location', 'elevation', 'state_id'];

    public function state()
    {
        return $this->belongsTo(State::class);
    }

    public function suburbs()
    {
        return $this->hasMany(Suburb::class);
    }

    public function resorts()
    {
        return $this->hasMany(Resort::class);
    }
    
}
