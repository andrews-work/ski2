<?php

namespace App\Http\Controllers\Forums;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreCommentRequest;
use App\Services\CommentService;
use Illuminate\Support\Facades\Log;
use Illuminate\Auth\Access\AuthorizationException;
use App\Models\Forums\PostCommentModel;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class PostCommentController extends Controller
{
    use AuthorizesRequests;

    protected $commentService;

    public function __construct(CommentService $commentService)
    {
        $this->commentService = $commentService;
    }

    public function list($postId)
    {
        try {
            $comments = $this->commentService->getCommentsForPost($postId);
            return response()->json($comments);
        } catch (\Exception $e) {
            Log::error('Error fetching comments: ' . $e->getMessage());
            return response()->json(['message' => 'An error occurred while fetching comments.'], 500);
        }
    }

    public function create(StoreCommentRequest $request, $postId)
    {
        try {
            // Authorize the action
            $this->authorize('create', PostCommentModel::class);

            // Delegate to the service
            $comment = $this->commentService->createComment($postId, $request->validated());
            return response()->json([
                'message' => 'Comment created successfully!',
                'comment' => $comment,
            ]);
        } catch (AuthorizationException $e) {
            return response()->json(['message' => $e->getMessage()], 403);
        } catch (\Exception $e) {
            Log::error('Error creating comment: ' . $e->getMessage());
            return response()->json(['message' => 'An error occurred while creating the comment.'], 500);
        }
    }

    public function update(StoreCommentRequest $request, $commentId)
    {
        Log::info('update');
        try {
            $comment = PostCommentModel::findOrFail($commentId);

            $this->authorize('update', $comment);

            $comment = $this->commentService->updateComment($commentId, $request->validated());
            return response()->json([
                'message' => 'Comment updated successfully!',
                'comment' => $comment,
            ]);
        } catch (AuthorizationException $e) {
            return response()->json(['message' => $e->getMessage()], 403);
        } catch (\Exception $e) {
            Log::error('Error updating comment: ' . $e->getMessage());
            return response()->json(['message' => 'An error occurred while updating the comment.'], 500);
        }
    }

    public function delete($commentId)
    {
        try {
            $comment = PostCommentModel::findOrFail($commentId);

            // Authorize the action
            $this->authorize('delete', $comment);

            // Delegate to the service
            $this->commentService->deleteComment($commentId);
            return response()->json(['message' => 'Comment deleted successfully!']);
        } catch (AuthorizationException $e) {
            return response()->json(['message' => $e->getMessage()], 403);
        } catch (\Exception $e) {
            Log::error('Error deleting comment: ' . $e->getMessage());
            return response()->json(['message' => 'An error occurred while deleting the comment.'], 500);
        }
    }

    public function userComments($userId)
    {
        try {
            // Fetch comments for the user
            $comments = PostCommentModel::where('user_id', $userId)
                ->with('post') // Optionally load the related post
                ->orderBy('created_at', 'desc')
                ->get();

            // Log the comments for debugging
            Log::info('User Comments:', $comments->toArray());

            return response()->json([
                'userComments' => $comments,
            ]);
        } catch (\Exception $e) {
            Log::error('Error fetching user comments: ' . $e->getMessage());
            return response()->json(['message' => 'An error occurred while fetching user comments.'], 500);
        }
    }
}
