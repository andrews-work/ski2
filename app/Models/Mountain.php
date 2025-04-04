<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

// Mountain Model
class Mountain extends Model
{
    protected $table = 'mountains';
    protected $fillable = [
        'name', 'slug',
        'base_elevation', 'summit_elevation',
        'vertical_drop', 'suburb_id',
        'resort_id',
        'start', 'end',
    ];

    public function resort()
    {
        return $this->belongsTo(Resort::class);
    }

    public function suburb()
    {
        return $this->belongsTo(Suburb::class);
    }

    public function chairlifts()
    {
        return $this->hasMany(Chairlift::class);
    }

    public function restaurants()
    {
        return $this->hasMany(Restaurant::class);
    }
}
