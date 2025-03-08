<?php

namespace App\Models\Forums;

use Illuminate\Database\Eloquent\Model;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Database\Factories\PostCommentFactory;

class PostCommentModel extends Model
{
    use HasFactory;

    protected $table = 'post_comments';
    protected $fillable = [
        'user_id',
        'forum_post_id',
        'content',
    ];

    protected static function newFactory()
    {
        return PostCommentFactory::new();
    }

    public function user()
    {
        return $this -> belongsTo(User::class);
    }

    public function post()
    {
        return $this -> belongsTo(PostModel::class, 'forum_post_id');
    }
}
