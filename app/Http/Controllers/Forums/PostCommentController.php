<?php

namespace App\Http\Controllers\Forums;

use App\Http\Controllers\Controller;
use App\Models\Forums\PostModel;
use Illuminate\Http\Request;
use App\Models\Forums\PostCommentModel;
use Illuminate\Support\Facades\Auth;

class PostCommentController extends Controller
{
    public function list($postId)
    {
        $post = PostModel::with('comments.user')->findOrFail($postId);
        return response()->json($post->comments);
    }

    public function create(Request $request, $postId)
    {
        $request->validate([
            'content' => 'required|string',
        ]);

        $comment = PostCommentModel::create([
            'user_id' => Auth::id(),
            'forum_post_id' => $postId,
            'content' => $request->input('content'),
        ]);

        return response()->json($comment, 201);
    }

    public function update(Request $request, $commentId)
    {
        $comment = PostCommentModel::findOrFail($commentId);

        // Ensure the authenticated user owns the comment
        if ($comment->user_id !== Auth::id()) {
            return response()->json(['error' => 'Unauthorized'], 403);
        }

        $request->validate([
            'content' => 'required|string',
        ]);

        $comment->update([
            'content' => $request->input('content'),
        ]);

        return response()->json($comment);
    }

    public function delete($commentId)
    {
        $comment = PostCommentModel::findOrFail($commentId);

        // Ensure the authenticated user owns the comment
        if ($comment->user_id !== Auth::id()) {
            return response()->json(['error' => 'Unauthorized'], 403);
        }

        $comment->delete();

        return response()->json(['message' => 'Comment deleted']);
    }
}
