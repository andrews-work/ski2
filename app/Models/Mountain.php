<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Mountain extends Model
{
    protected $table = '';
    protected $fillable = ['name', 'base_elevation', 'summit_elevation', 'vertical_drop', 'resort_id'];

    public function resort()
    {
        return $this->belongsTo(Resort::class);
    }

    public function bases()
    {
        return $this->hasMany(Base::class);
    }
}
