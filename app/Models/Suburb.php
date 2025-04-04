<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Suburb extends Model
{
    protected $table = 'suburbs';
    protected $fillable = [
        'name', 'slug',
        'location', 'town_id',
        'ski in', 'ski out',
        'companies',
    ];

    public function town()
    {
        return $this->belongsTo(Town::class);
    }
}
