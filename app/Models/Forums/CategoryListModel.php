<?php

namespace App\Models\Forums;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Database\Factories\PostFactory;

class CategoryListModel extends Model
{
    use HasFactory;

    protected $table = 'category_list';
    protected $fillable = ['name', 'description', 'parent_id', 'slug', 'type'];

    protected static function newFactory()
    {
        return PostFactory::new();
    }

    public function parent()
    {
        return $this->belongsTo(CategoryListModel::class, 'parent_id');
    }

    public function children()
    {
        return $this->hasMany(CategoryListModel::class, 'parent_id');
    }

    public function posts()
    {
        return $this->hasMany(PostModel::class);
    }
}
