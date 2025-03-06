<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Forums\PostModel;

class PostSeeder extends Seeder
{
    public function run(): void
    {
        $users = User::all();

        $users->each(function ($user) {
            PostModel::factory()
                ->count(10)
                ->create(['user_id' => $user->id]);
        });
    }
}
