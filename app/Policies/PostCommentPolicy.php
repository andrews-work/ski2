<?php

namespace App\Policies;

use App\Models\Forums\PostCommentModel;
use App\Models\User;
use Illuminate\Auth\Access\Response;

class PostCommentPolicy
{
    public function create(User $user): bool
    {
        return $user !== null;
    }

    public function update(User $user, PostCommentModel $comment): bool
    {
        return $user->id === $comment->user_id;
    }

    public function delete(User $user, PostCommentModel $comment): bool
    {
        return $user->id === $comment->user_id;
    }
}
