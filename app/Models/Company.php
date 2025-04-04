<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Company extends Model
{
    protected $table = 'companies';
    protected $fillable = [
        'name', 'slug',
        'employees', 'manager', 'ceo',
        'long', 'lat', 'suburb',
        'open', 'close',
        'type', 'delivery'
    ];

    public function suburb()
    {
        return $this -> belongsTo(Suburb::class);
    }
}
