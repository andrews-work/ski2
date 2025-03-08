<?php

namespace Database\Factories;

use App\Models\Forums\PostCommentModel;
use App\Models\User;
use App\Models\Forums\PostModel;
use Illuminate\Database\Eloquent\Factories\Factory;

class PostCommentFactory extends Factory
{
    protected $model = PostCommentModel::class;

    public function definition()
    {
        $createdAt = $this->faker->dateTimeBetween('-1 year', 'now');

        return [
            'user_id' => User::factory(),
            'forum_post_id' => PostModel::factory(),
            'content' => $this->faker->paragraph,
            'created_at' => $createdAt,
            'updated_at' => $createdAt,
        ];
    }
}
