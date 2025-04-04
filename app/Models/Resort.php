<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Resort extends Model
{
    use HasFactory;

    protected $table = 'resorts';
    protected $appends = ['local_time'];
    protected $fillable = [
        'name', 'slug',
        'town_id', 'mountain_id',
        'latitude', 'longitude', 'image_url',
        'open', 'close', 'start', 'end'
    ];

    // accessors
    public function getTimezoneAttribute()
    {
        return $this->town->state->timezone;
    }

    public function getLocalTimeAttribute()
    {
        return now()->setTimezone($this->timezone)->format('g:ia');
    }

    // relationships
    public function town()
    {
        return $this->belongsTo(Town::class);
    }

    public function mountains()
    {
        return $this->hasMany(Mountain::class);
    }

    public function categories()
    {
        return $this->belongsToMany(Category::class);
    }

    public function country()
{
    return $this->hasOneThrough(
        Country::class,
        Town::class,
        'id', // Foreign key on towns table
        'id', // Foreign key on countries table
        'town_id', // Local key on resorts table
        'state_id' // Local key on towns table (which connects to states)
    )->through('town.state');
}
}
