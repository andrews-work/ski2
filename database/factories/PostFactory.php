<?php

namespace Database\Factories;

use App\Models\Forums\PostModel;
use App\Models\User;
use App\Models\Forums\CategoryListModel;
use Illuminate\Database\Eloquent\Factories\Factory;
use Carbon\Carbon;

class PostFactory extends Factory
{
    protected $model = PostModel::class;

    public function definition(): array
    {
        return [
            'user_id' => User::inRandomOrder()->first()->id,
            'title' => fake()->sentence(),
            'content' => fake()->paragraph(),
            'category_id' => CategoryListModel::inRandomOrder()->first()->id,
            'created_at' => Carbon::now()->subDays(rand(1, 30)), 
            'updated_at' => Carbon::now(),
        ];
    }
}
