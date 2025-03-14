<?php

namespace Database\Seeders\forumCategories;

use App\Models\Forums\CategoryListModel;
use App\Models\Forums\TopicModel;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ResortTopicsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $resorts = CategoryListModel::where('type', 'resort')->get();
        $topics = TopicModel::all();

        foreach ($resorts as $resort) {
            foreach ($topics as $topic) {
                $resort->topics()->attach($topic->id);
            }
        }
    }
}
