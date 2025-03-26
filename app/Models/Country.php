<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Country extends Model
{

    use HasFactory;

    protected $table = 'countries';
    protected $fillable = ['name', 'slug', 'continent_id'];

    public function continent()
    {
        return $this -> belongsTo(Continent::class, 'continent_id');
    }

    public function resorts()
    {
        return $this -> hasMany (Resort::class);
    }
}
