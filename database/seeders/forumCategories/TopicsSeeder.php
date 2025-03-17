<?php

namespace Database\Seeders\forumCategories;

use App\Models\Forums\TopicModel;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class TopicsSeeder extends Seeder
{

    protected $table = 'topics';

    public function run(): void
    {
        $topics = [
            ['name' => 'Travel', 'slug' => 'travel'],
            ['name' => 'Restaurants', 'slug' => 'restaurants'],
            ['name' => 'Rentals', 'slug' => 'rentals'],
            ['name' => 'Bars & Clubs', 'slug' => 'bars'],
            ['name' => 'Park', 'slug' => 'park'],
            ['name' => 'Shops', 'slug' => 'shops'],
            ['name' => 'Local Events', 'slug' => 'events'],
            ['name' => 'News', 'slug' => 'news'],
            ['name' => 'Mountain', 'slug' => 'mountain'],
            ['name' => 'General', 'slug' => 'general'],
            ['name' => 'Not-Skiing Activities', 'slug' => 'not-skiing'],
            ['name' => 'Backcountry', 'slug' => 'backcountry'],
            ['name' => 'Suggestions', 'slug' => 'suggestions'],
        ];

        foreach ($topics as $topicData) {
            TopicModel::updateOrCreate(['slug' => $topicData['slug']], $topicData);
        }
    }
}
