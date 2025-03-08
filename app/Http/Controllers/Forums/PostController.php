<?php

namespace App\Http\Controllers\Forums;

use App\Http\Controllers\Controller;
use App\Models\Forums\PostModel;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Auth;
use App\Models\Forums\CategoryListModel;
use Inertia\Inertia;
use App\Http\Requests\CreatePostRequest;

class PostController extends Controller
{
    public function postList()
    {
        $posts = PostModel::with(['user', 'category'])
            ->orderBy('created_at', 'desc')
            ->get();

        return inertia('Forums', [
            'post' => $posts,
        ]);
    }

    public function single($postId)
    {
        $post = PostModel::with(['user', 'category', 'comments.user'])->findOrFail($postId);

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
            'userPost' => null,
        ]);
    }

    public function userPosts($userId)
    {
        $posts = PostModel::with(['user', 'category'])
            ->where('user_id', $userId)
            ->orderBy('created_at', 'desc')
            ->get();

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

    public function createPost(CreatePostRequest $request)
    {
        Log::info('PostController - createPost');

        Log::info('validated' , $request -> validated());

        $post = PostModel::create([
            'user_id' => Auth::user()->id,
            'title' => $request['title'],
            'content' => $request['content'],
            'category_id' => $request['category_id'],
        ]);

        Log::info('Post created:', $post->toArray());

        return redirect()->route('posts', ['postId' => $post->id]);
    }

    public function update()
    {
    }

    public function delete()
    {
    }
}
