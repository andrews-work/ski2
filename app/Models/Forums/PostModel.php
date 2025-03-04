<?php

namespace App\Models\Forums;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\User;
use App\Models\Forums\CategoryListModel;
use App\Models\Forums\PostCommentModel;

class PostModel extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'title',
        'content',
        'category_id',
    ];

    public function user()
    {
        return $this -> belongsTo(User::class);
    }

    public function category()
    {
        return $this -> belongsTo(CategoryListModel::class);
    }

    public function comments()
    {
        return $this -> belongsTo(PostCommentModel::class);
    }
}
