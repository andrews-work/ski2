<?php

namespace Database\Seeders;

use App\Models\Forums\PostCommentModel;
use App\Models\Forums\PostModel;
use Illuminate\Database\Seeder;

class PostCommentSeeder extends Seeder
{
    public function run()
    {
        // Get all posts
        $posts = PostModel::all();

        $posts->each(function ($post) {
            
            $commentCount = rand(0, 5);
            PostCommentModel::factory()->count($commentCount)->create([
                'forum_post_id' => $post->id,
            ]);
        });
    }
}
