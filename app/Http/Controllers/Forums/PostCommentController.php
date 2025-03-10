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
            // Authorize the action
            $this->authorize('create', PostCommentModel::class);

            // Delegate to the service to create the comment
            $comment = $this->commentService->createComment($postId, $request->validated());

            // Fetch the post and its comments after creating the new comment
            $post = $comment->post; // Get the post associated with the new comment
            $comments = $this->commentService->getCommentsForPost($post->id); // Get the updated list of comments

            // Fetch additional data required for the view
            $categories = CategoryListModel::all(); // Fetch categories if needed
            $subcategories = []; // You can fetch subcategories if necessary
            $continents = []; // Fetch continents if needed
            $countries = []; // Fetch countries if needed
            $resorts = []; // Fetch resorts if needed
            $posts = []; // Fetch posts if needed

            // Return the Inertia response with the updated post and comments
            return Inertia::render('Forums', [
                'post' => $post,
                'comments' => $comments, // Send updated list of comments to the front-end
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
            // Find the comment by its ID
            $comment = PostCommentModel::findOrFail($commentId);
            Log::info('Found comment', ['comment' => $comment]);

            // Authorize the action
            $this->authorize('update', $comment);
            Log::info('Authorization passed for updating comment', ['commentId' => $commentId]);

            // Perform the update via the service
            $comment = $this->commentService->updateComment($commentId, $request->validated());
            Log::info('Comment updated', ['updatedComment' => $comment]);

            // Fetch the post and its comments after update
            $post = $comment->post;
            Log::info('Post fetched for the comment', ['postId' => $post->id]);

            $comments = $this->commentService->getCommentsForPost($post->id);
            Log::info('Comments fetched for the post', ['postId' => $post->id, 'commentsCount' => count($comments)]);

            // Fetch additional data required for the view
            $categories = CategoryListModel::all(); // Fetch categories
            $subcategories = []; // Fetch subcategories if needed
            $continents = []; // Fetch continents if needed
            $countries = []; // Fetch countries if needed
            $resorts = []; // Fetch resorts if needed
            $posts = []; // Fetch posts if needed

            // Return the Inertia response with updated comment data
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

//     public function update(StoreCommentRequest $request, $commentId)
// {
//     Log::info('Update method started', ['commentId' => $commentId]);

//     try {
//         // Find the comment by its ID
//         $comment = PostCommentModel::findOrFail($commentId);
//         Log::info('Found comment', ['comment' => $comment]);

//         // Authorize the action
//         $this->authorize('update', $comment);
//         Log::info('Authorization passed for updating comment', ['commentId' => $commentId]);

//         // Perform the update via the service
//         $comment = $this->commentService->updateComment($commentId, $request->validated());
//         Log::info('Comment updated', ['updatedComment' => $comment]);

//         // Return a JSON response with the updated comment (no full page reload)
//         return response()->json([
//             'comment' => $comment,  // Send back the updated comment
//         ]);

//     } catch (AuthorizationException $e) {
//         Log::error('Authorization error while updating comment', ['commentId' => $commentId, 'error' => $e->getMessage()]);
//         return response()->json(['message' => $e->getMessage()], 403);
//     } catch (\Exception $e) {
//         Log::error('Error updating comment', [
//             'commentId' => $commentId,
//             'error' => $e->getMessage(),
//             'stack' => $e->getTraceAsString()
//         ]);
//         return response()->json(['message' => 'An error occurred while updating the comment.'], 500);
//     }
// }


    public function delete($commentId)
    {
        try {
            $comment = PostCommentModel::findOrFail($commentId);

            // Authorize the action
            $this->authorize('delete', $comment);

            // Fetch the post associated with the comment
            $post = $comment->post;

            // Delegate to the service
            $this->commentService->deleteComment($commentId);

            // Fetch additional data required for the view
            $categories = CategoryListModel::all(); // Fetch categories
            $subcategories = []; // Fetch subcategories if needed
            $continents = []; // Fetch continents if needed
            $countries = []; // Fetch countries if needed
            $resorts = []; // Fetch resorts if needed
            $posts = []; // Fetch posts if needed

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

