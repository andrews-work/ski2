<?php

namespace App\Http\Controllers\Forums;

use App\Http\Controllers\Controller;
use App\Models\Forums\PostModel;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Auth;
use App\Models\Forums\CategoryListModel;
use Inertia\Inertia;

class PostController extends Controller
{
    public function postList()
    {
        Log::info('PostController - postList');

        $posts = PostModel::with(['user', 'category'])
            ->orderBy('created_at', 'desc')
            ->get();

        Log::info('posts', ['posts' => $posts]);

        return inertia('Forums', [
            'post' => $posts,
        ]);
    }

    public function single($postId)
    {
        Log::info('PostController - single');

        $post = PostModel::with(['user', 'category'])->findOrFail($postId);

        Log::info('Viewing post', [
            'post_id' => $post->id,
            'post_title' => $post->title,
            'post_category' => $post->category,
        ]);

        $categories = CategoryListModel::whereNull('parent_id')->get();
        $subcategories = CategoryListModel::whereNotNull('parent_id')->get();
        $continents = CategoryListModel::where('type', 'continent')->get();
        $countries = CategoryListModel::where('type', 'country')->get();
        $resorts = CategoryListModel::where('type', 'resort')->get();

        $posts = PostModel::with(['user', 'category'])
            ->orderBy('created_at', 'desc')
            ->get();

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
        ]);
    }

    public function userPosts($userId)
    {
        Log::info('PostController - userPosts');

        // Fetch posts by the specific user
        $posts = PostModel::with(['user', 'category'])
            ->where('user_id', $userId)
            ->orderBy('created_at', 'desc')
            ->get();

        Log::info('Posts for user', ['user_id' => $userId, 'posts' => $posts]);

        // Get categories for the sidebar
        $categories = CategoryListModel::whereNull('parent_id')->get();
        $subcategories = CategoryListModel::whereNotNull('parent_id')->get();
        $continents = CategoryListModel::where('type', 'continent')->get();
        $countries = CategoryListModel::where('type', 'country')->get();
        $resorts = CategoryListModel::where('type', 'resort')->get();

        return Inertia::render('Forums', [
            'userPost' => $posts,
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


    public function create()
    {
        Log::info('PostController - Create');
    }

    public function update()
    {
        Log::info('PostController - Update');
    }

    public function delete()
    {
        Log::info('PostController - Delete');
    }
}
