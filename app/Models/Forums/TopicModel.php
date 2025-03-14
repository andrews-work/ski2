<?php

namespace App\Models\Forums;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Forums\CategoryListModel;

class TopicModel extends Model
{
    use HasFactory;

    protected $table = 'topics';
    protected $fillable = ['name', 'slug'];

    public function resorts()
    {
        return $this -> belongsToMany(CategoryListModel::class, 'resort_topics', 'topic_id', 'resort_id');
    }
}
