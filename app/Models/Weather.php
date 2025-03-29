<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Weather extends Model
{
    protected $fillable = ['resort_id', 'data', 'source', 'expries_at'];
    protected $table = '';

    public function Resort()
    {
        return $this -> belongsTo(Resort::class);
    }
}
