<?php

namespace Database\Seeders;

use App\Models\Forums\PostCommentModel;
use App\Models\Forums\PostModel;
use App\Models\User;
use Illuminate\Database\Seeder;

class PostCommentSeeder extends Seeder
{
    public function run()
    {
        $users = User::all();

        $users->each(function ($user) {
            $posts = PostModel::inRandomOrder()->limit(30)->get();

            $posts->each(function ($post) use ($user) {

                PostCommentModel::factory()->create([
                    'forum_post_id' => $post->id,
                    'user_id' => $user->id,
                ]);
            });
        });
    }
}
