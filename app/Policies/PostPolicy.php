<?php

namespace App\Policies;

use App\Models\Forums\PostModel;
use App\Models\User;

class PostPolicy
{
    public function create(User $user): bool
    {
        return $user !== null;
    }

    public function update(User $user, PostModel $post): bool
    {
        return $user->id === $post->user_id;
    }

    public function delete(User $user, PostModel $post): bool
    {
        return $user->id === $post->user_id;
    }
}
