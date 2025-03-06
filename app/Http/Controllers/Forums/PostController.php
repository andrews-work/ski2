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

    // Fetch the post from the database using the $postId
    $post = PostModel::with(['user', 'category'])->findOrFail($postId);

    Log::info('Viewing post', [
        'post_id' => $post->id,
        'post_title' => $post->title,
    ]);

    // Fetch all top-level categories (if needed)
    $categories = CategoryListModel::whereNull('parent_id')->get();

    return Inertia::render('Forums', [
        'post' => $post,
        'category' => $post->category, // Pass the post's category
        'categories' => $categories, // Pass all top-level categories
    ]);
}

    public function create(){
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
