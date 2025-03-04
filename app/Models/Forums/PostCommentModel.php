<?php

namespace App\Models\Forums;

use Illuminate\Database\Eloquent\Model;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class PostCommentModel extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'forum_post_id',
        'content',
    ];

    public function user()
    {
        return $this -> belongsTo(User::class);
    }

    public function post()
    {
        return $this -> belongsTo(PostModel::class);
    }
}
