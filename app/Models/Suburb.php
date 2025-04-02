<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Suburb extends Model
{
    protected $table = '';
    protected $fillable = ['name', 'location', 'town_id'];

    public function town()
    {
        return $this->belongsTo(Town::class);
    }

    public function bases()
    {
        return $this->hasMany(Base::class);
    }
}
