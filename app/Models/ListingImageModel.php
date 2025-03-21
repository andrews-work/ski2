<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ListingImageModel extends Model
{
    protected $table = 'listing_images';

    protected $fillable = [
        'path', 'listing_id'
    ];

    public function listing()
    {
        return $this -> belongsTo(ListingModel::class, 'listing_id');
    }
}
