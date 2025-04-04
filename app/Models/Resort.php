<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Resort extends Model
{
    use HasFactory;

    protected $appends = ['local_time', 'is_open'];
    protected $fillable = [
        'name', 'slug', 'town_id',
        'latitude', 'longitude', 'image_url',
        'open', 'close', 'start', 'end', 'base_elevation'
    ];

    // Accessors
    public function getTimezoneAttribute()
    {
        return optional($this->town)->state->timezone ?? 'UTC';
    }

    public function getLocalTimeAttribute()
    {
        return now()->setTimezone($this->timezone)->format('g:ia');
    }

    public function getIsOpenAttribute()
    {
        // if (!$this->open || !$this->close) return null;

        // $now = now()->setTimezone($this->timezone);
        // $open = today()->setTime(
        //     $this->open->hour,
        //     $this->open->minute
        // );
        // $close = today()->setTime(
        //     $this->close->hour,
        //     $this->close->minute
        // );

        // return $now->between($open, $close);
    }

    // Relationships
    public function town()
    {
        return $this->belongsTo(Town::class);
    }

    public function country()
    {
        return $this->belongsToThrough(Country::class, Town::class);
    }

    public function state()
    {
        return $this->belongsToThrough(State::class, Town::class);
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
