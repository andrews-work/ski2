<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Restaurant extends Model
{
    protected $table = 'restaurants';
    protected $fillable = [
        'name', 'slug',
        'type', 'cuisine',
        'menu', 'cost',
        'open', 'close',
        'lat', 'long', 'suburb_id', 'address', 
        'takeaway', 'alcohol', 'byo'
    ];

    public function mountain()
    {
        return $this->belongsTo(Mountain::class);
    }

    public function suburb()
    {
        return $this->belongsTo(Suburb::class);
    }

    public function chairlifts()
    {
        return $this->hasMany(Chairlift::class);
    }
}
