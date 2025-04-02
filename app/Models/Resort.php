<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Resort extends Model
{
    use HasFactory;

    protected $table = 'resorts';
    protected $fillable = ['name', 'slug', 'country_id', 'town_id', 'latitude', 'longitude','base_elevation', 'image_url', 'state', 'state_code', 'timezone', 'start',];

    public function country()
    {
        return $this->belongsTo(Country::class);
    }

    public function town()
    {
        return $this->belongsTo(Town::class);
    }

    public function mountains()
    {
        return $this->hasMany(Mountain::class);
    }

    public function bases()
    {
        return $this->hasMany(Base::class);
    }

    public function categories()
    {
        return $this->belongsToMany(Category::class);
    }

    public function getStateAttribute()
    {
        return $this->town?->state ?? $this->attributes['state'];
    }

    public function getStateCodeAttribute()
    {
        return $this->town?->state?->code ?? $this->attributes['state_code'];
    }
}
