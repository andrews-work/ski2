<?php

namespace App\Models\Forums;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\User;
use App\Models\Forums\CategoryListModel;
use App\Models\Forums\PostCommentModel;
use Database\Factories\PostFactory;

class PostModel extends Model
{
    use HasFactory;

    protected $table = 'posts';
    protected $fillable = [
        'user_id',
        'title',
        'content',
        'category_id',
        'topic_id',
    ];

    protected static function newFactory()
    {
        return PostFactory::new();
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function category()
    {
        return $this->belongsTo(CategoryListModel::class);
    }

    public function topic()
    {
        return $this->belongsTo(TopicModel::class);
    }

    public function comments()
    {
        return $this->hasMany(PostCommentModel::class, 'forum_post_id');
    }
}
