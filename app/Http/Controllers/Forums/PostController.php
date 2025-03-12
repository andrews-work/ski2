<?php

namespace App\Http\Controllers\Forums;

use App\Http\Controllers\Controller;
use App\Http\Requests\PostRequest;
use App\Services\PostService;
use App\Models\Forums\PostModel;
use Illuminate\Support\Facades\Log;
use Illuminate\Auth\Access\AuthorizationException;
use Inertia\Inertia;
use App\Models\Forums\CategoryListModel;
use App\Models\Forums\PostCommentModel;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class PostController extends Controller
{
    use AuthorizesRequests;

    protected $postService;

    public function __construct(PostService $postService)
    {
        $this->postService = $postService;
    }

    public function postList()
    {
        $posts = $this->postService->getAllPosts();
        return inertia('Forums', [
            'post' => $posts,
        ]);
    }

    public function single($postId)
    {
        $post = $this->postService->getPost($postId);

        $categories = CategoryListModel::whereNull('parent_id')->get();
        $subcategories = CategoryListModel::whereNotNull('parent_id')->get();
        $continents = CategoryListModel::where('type', 'continent')->get();
        $countries = CategoryListModel::where('type', 'country')->get();
        $resorts = CategoryListModel::where('type', 'resort')->get();

        $posts = $this->postService->getAllPosts();

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
    }

    public function userPosts($userId)
    {
        $posts = $this->postService->getUserPosts($userId);

        $comments = PostCommentModel::where('user_id', $userId)
            ->with('post')
            ->orderBy('created_at', 'desc')
            ->get();

        $categories = CategoryListModel::whereNull('parent_id')->get();
        $subcategories = CategoryListModel::whereNotNull('parent_id')->get();
        $continents = CategoryListModel::where('type', 'continent')->get();
        $countries = CategoryListModel::where('type', 'country')->get();
        $resorts = CategoryListModel::where('type', 'resort')->get();

        return Inertia::render('Forums', [
            'userPost' => $posts,
            'userComments' => $comments,
            'categories' => $categories,
            'subcategories' => $subcategories,
            'continents' => $continents,
            'countries' => $countries,
            'resorts' => $resorts,
            'continent' => null,
            'country' => null,
            'resort' => null,
            'subcategory' => null,
            'category' => null,
            'posts' => $posts,
            'post' => null,
        ]);
    }

    public function showCreatePost()
    {
        $categories = CategoryListModel::whereNull('parent_id')->get();
        $subcategories = CategoryListModel::whereNotNull('parent_id')->get();

        return Inertia::render('Forums', [
            'createPost' => true,
            'categories' => $categories,
            'subcategories' => $subcategories,
            'continent' => null,
            'continents' => null,
            'category' => null,
            'country' => null,
            'resort' => null,
            'subcategory' => null,
            'userPost' => null,
        ]);
    }

    public function createPost(PostRequest $request)
    {
        try {
            $this->authorize('create', PostModel::class);

            $post = $this->postService->createPost($request->validated());

            return redirect()->route('posts', ['postId' => $post->id]);
        } catch (AuthorizationException $e) {
            return response()->json(['message' => $e->getMessage()], 403);
        } catch (\Exception $e) {
            Log::error('Error creating post: ' . $e->getMessage());
            return response()->json(['message' => 'An error occurred while creating the post.'], 500);
        }
    }

    public function update(PostRequest $request, $postId)
    {
        Log::info('update');

        try {
            $post = PostModel::findOrFail($postId);

            $this->authorize('update', $post);

            $post = $this->postService->updatePost($postId, $request->validated());

            return redirect()->route('posts', ['postId' => $post->id]);
        } catch (AuthorizationException $e) {
            return response()->json(['message' => $e->getMessage()], 403);
        } catch (\Exception $e) {
            Log::error('Error updating post: ' . $e->getMessage());
            return response()->json(['message' => 'An error occurred while updating the post.'], 500);
        }
    }

    public function delete($postId)
    {
        try {
            $post = PostModel::findOrFail($postId);

            $this->authorize('delete', $post);

            $this->postService->deletePost($postId);

            return redirect()->route('forums')->with('success', 'Post deleted successfully!');
        } catch (AuthorizationException $e) {
            return response()->json(['message' => $e->getMessage()], 403);
        } catch (\Exception $e) {
            Log::error('Error deleting post: ' . $e->getMessage());
            return response()->json(['message' => 'An error occurred while deleting the post.'], 500);
        }
    }
}
