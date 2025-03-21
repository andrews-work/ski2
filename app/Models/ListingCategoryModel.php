<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ListingCategoryModel extends Model
{
    protected $table = 'listing_categories';

    protected $fillable = [
        'name',
    ];
}
