<?php

namespace App\Http\Controllers\Forums;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreCommentRequest;
use App\Services\CommentService;
use Illuminate\Support\Facades\Log;
use Illuminate\Auth\Access\AuthorizationException;
use App\Models\Forums\PostCommentModel;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use App\Models\Forums\CategoryListModel;
use Inertia\Inertia;

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
            $this->authorize('create', PostCommentModel::class);
            $comment = $this->commentService->createComment($postId, $request->validated());
            $post = $comment->post;
            $comments = $this->commentService->getCommentsForPost($post->id);
            $categories = CategoryListModel::all();
            $subcategories = [];
            $continents = [];
            $countries = [];
            $resorts = [];
            $posts = [];

            return Inertia::render('Forums', [
                'post' => $post,
                'comments' => $comments,
                'categories' => $categories,
                'subcategories' => $subcategories,
                'continents' => $continents,
                'countries' => $countries,
                'resorts' => $resorts,
                'posts' => $posts,
                'continent' => null,
                'country' => null,
                'resort' => null,
                'subcategory' => null,
                'userPost' => null,
            ]);
        } catch (AuthorizationException $e) {
            return Inertia::render('Error', [
                'message' => $e->getMessage(),
            ])->with('status', 403);
        } catch (\Exception $e) {
            Log::error('Error creating comment: ' . $e->getMessage());
            return Inertia::render('Error', [
                'message' => 'An error occurred while creating the comment.',
            ])->with('status', 500);
        }
    }

    public function update(StoreCommentRequest $request, $commentId)
    {
        Log::info('Update method started', ['commentId' => $commentId]);

        try {
            $comment = PostCommentModel::findOrFail($commentId);
            Log::info('Found comment', ['comment' => $comment]);

            $this->authorize('update', $comment);
            Log::info('Authorization passed for updating comment', ['commentId' => $commentId]);

            $comment = $this->commentService->updateComment($commentId, $request->validated());
            Log::info('Comment updated', ['updatedComment' => $comment]);

            $post = $comment->post;
            Log::info('Post fetched for the comment', ['postId' => $post->id]);

            $comments = $this->commentService->getCommentsForPost($post->id);
            Log::info('Comments fetched for the post', ['postId' => $post->id, 'commentsCount' => count($comments)]);

            $categories = CategoryListModel::all();
            $subcategories = [];
            $continents = [];
            $countries = [];
            $resorts = [];
            $posts = [];

            return Inertia::render('Forums', [
                'post' => $post,
                'category' => $post->category,
                'categories' => $categories,
                'subcategories' => $subcategories,
                'continents' => $continents,
                'countries' => $countries,
                'resorts' => $resorts,
                'posts' => $posts,
                'continent' => null,
                'country' => null,
                'resort' => null,
                'subcategory' => null,
                'userPost' => null,
            ]);
        } catch (AuthorizationException $e) {
            Log::error('Authorization error while updating comment', ['commentId' => $commentId, 'error' => $e->getMessage()]);
            return Inertia::render('Error', ['message' => $e->getMessage()])->with('status', 403);
        } catch (\Exception $e) {
            Log::error('Error updating comment', [
                'commentId' => $commentId,
                'error' => $e->getMessage(),
                'stack' => $e->getTraceAsString()
            ]);
            return Inertia::render('Error', ['message' => 'An error occurred while updating the comment.'])->with('status', 500);
        }
    }

    public function delete($commentId)
    {
        try {
            $comment = PostCommentModel::findOrFail($commentId);
            $this->authorize('delete', $comment);
            $post = $comment->post;
            $this->commentService->deleteComment($commentId);
            $categories = CategoryListModel::all();
            $subcategories = [];
            $continents = [];
            $countries = [];
            $resorts = [];
            $posts = [];

            return Inertia::render('Forums', [
                'post' => $post,
                'category' => $post->category,
                'categories' => $categories,
                'subcategories' => $subcategories,
                'continents' => $continents,
                'countries' => $countries,
                'resorts' => $resorts,
                'posts' => $posts,
                'continent' => null,
                'country' => null,
                'resort' => null,
                'subcategory' => null,
                'userPost' => null,
            ]);
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
            $comments = PostCommentModel::where('user_id', $userId)
                ->with('post')
                ->orderBy('created_at', 'desc')
                ->get();

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
