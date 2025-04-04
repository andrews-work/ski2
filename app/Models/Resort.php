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
}
