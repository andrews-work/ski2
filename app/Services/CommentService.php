<?php

namespace App\Services;

use App\Models\Forums\PostCommentModel;
use App\Models\Forums\PostModel;
use Illuminate\Support\Facades\Auth;

class CommentService
{
    public function getCommentsForPost($postId)
    {
        return PostModel::with('comments.user')->findOrFail($postId)->comments;
    }

    public function createComment($postId, array $data)
    {
        $post = PostModel::findOrFail($postId);
        return $post->comments()->create([
            'user_id' => Auth::id(),
            'content' => $data['content'],
        ]);
    }

    public function updateComment($commentId, array $data)
    {
        $comment = PostCommentModel::findOrFail($commentId);
        $comment->update($data);
        return $comment;
    }

    public function deleteComment($commentId)
    {
        $comment = PostCommentModel::findOrFail($commentId);
        $comment->delete();
    }
}
