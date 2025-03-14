<?php

namespace Database\Factories;

use App\Models\Forums\PostModel;
use App\Models\User;
use App\Models\Forums\CategoryListModel;
use App\Models\Forums\TopicModel;
use Illuminate\Database\Eloquent\Factories\Factory;
use Carbon\Carbon;

class PostFactory extends Factory
{
    protected $model = PostModel::class;

    public function definition(): array
    {
        $category = CategoryListModel::inRandomOrder()->first();

        $topicId = null;
        if ($category->type === 'resort') {
            $topicId = TopicModel::inRandomOrder()->first()->id;
        }

        return [
            'user_id' => User::inRandomOrder()->first()->id,
            'title' => fake()->sentence(),
            'content' => fake()->paragraph(),
            'category_id' => $category->id,
            'topic_id' => $topicId,
            'created_at' => Carbon::now()->subDays(rand(1, 30)),
            'updated_at' => Carbon::now(),
        ];
    }
}
