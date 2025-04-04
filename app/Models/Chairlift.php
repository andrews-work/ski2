<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

// Chairlift Model
class Chairlift extends Model
{
    protected $table = 'chairlifts';
    protected $fillable = [
        'name', 'slug',
        'mountain_id',
        'restaurant_id',
        'open', 'close',
        'start', 'end',
        'time', 'line',
        'seats', 'type',
        'cover'
    ];

    public function mountain()
    {
        return $this->belongsTo(Mountain::class);
    }

    public function restaurant()
    {
        return $this->belongsTo(Restaurant::class);
    }
}
