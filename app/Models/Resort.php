<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Resort extends Model
{
    use HasFactory;

    protected $table = 'resorts';
    protected $fillable = ['name', 'slug', 'country_id', 'latitude', 'longitude', 'base_elevation', 'image_url', 'nearest_city', 'state', 'state_code', 'local_time'];

    public function country()
    {
        return $this->belongsTo(Country::class);
    }

    public function categories()
    {
        return $this -> belongsToMany(Category::class);
    }
}
