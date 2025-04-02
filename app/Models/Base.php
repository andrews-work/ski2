<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Base extends Model
{
    protected $table = '';
    protected $fillable = ['name', 'location', 'description', 'resort_id', 'mountain_id', 'suburb_id'];

    public function resort()
    {
        return $this->belongsTo(Resort::class);
    }

    public function mountain()
    {
        return $this->belongsTo(Mountain::class);
    }

    public function suburb()
    {
        return $this->belongsTo(Suburb::class);
    }
}
