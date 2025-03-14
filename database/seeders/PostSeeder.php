<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Forums\PostModel;
use App\Models\Forums\CategoryListModel;
use App\Models\Forums\TopicModel;

class PostSeeder extends Seeder
{
    public function run(): void
    {
        $users = User::all();
        $categories = CategoryListModel::all();
        $topics = TopicModel::all();

        $users->each(function ($user) use ($categories, $topics) {
            PostModel::factory()
                ->count(10)
                ->create([
                    'user_id' => $user->id,
                    'category_id' => $categories->random()->id,
                    'topic_id' => function (array $attributes) use ($categories, $topics) {

                        $category = $categories->find($attributes['category_id']);
                        if ($category->type === 'resort') {
                            return $topics->random()->id;
                        }
                        return null;
                    },
                ]);
        });
    }
}
