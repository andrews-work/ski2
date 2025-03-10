<?php

namespace App\Services;

use App\Models\Forums\PostModel;
use Illuminate\Support\Facades\Auth;

class PostService
{
    public function createPost(array $data)
    {
        return PostModel::create([
            'user_id' => Auth::id(),
            'title' => $data['title'],
            'content' => $data['content'],
            'category_id' => $data['category_id'],
        ]);
    }

    public function updatePost($postId, array $data)
    {
        $post = PostModel::findOrFail($postId);
        $post->update($data);
        return $post;
    }

    public function deletePost($postId)
    {
        $post = PostModel::findOrFail($postId);
        $post->delete();
    }

    public function getPost($postId)
    {
        return PostModel::with(['user', 'category'])->findOrFail($postId);
    }

    public function getUserPosts($userId)
    {
        return PostModel::with(['user', 'category'])
            ->where('user_id', $userId)
            ->orderBy('created_at', 'desc')
            ->get();
    }

    public function getAllPosts()
    {
        return PostModel::with(['user', 'category'])
            ->orderBy('created_at', 'desc')
            ->get();
    }
}
