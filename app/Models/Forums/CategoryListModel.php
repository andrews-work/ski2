<?php

namespace App\Models\Forums;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Forums\TopicModel;

class CategoryListModel extends Model
{
    use HasFactory;

    protected $table = 'category_list';
    protected $fillable = ['name', 'description', 'parent_id', 'slug', 'type'];

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
        return $this->hasMany(PostModel::class, 'category_id');
    }

    public function topics()
    {
        return $this->belongsToMany(TopicModel::class, 'resort_topics', 'resort_id', 'topic_id');
    }
}
