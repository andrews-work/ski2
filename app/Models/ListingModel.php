<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ListingModel extends Model
{

    protected $table = 'listings';

    protected $fillable = [
        'description', 'title', 'price', 'images', 'category_id', 'condition', 'user_id', 'id'
    ];

    public function user()
    {
        return $this -> belongsTo(User::class);
    }

    public function category()
    {
        return $this -> belongsTo(ListingCategoryModel::class);
    }

    public function images()
    {
        return $this->hasMany(ListingImageModel::class, 'listing_id');
    }
}
