<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Testing\Fluent\Concerns\Has;

class Continent extends Model
{
    use HasFactory;

    protected $table = 'continents';
    protected $fillable = ['name', 'slug'];

    public function countries()
    {
        return $this -> hasMany(Country::class);
    }

}
