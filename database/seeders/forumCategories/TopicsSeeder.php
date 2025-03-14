<?php

namespace Database\Seeders\forumCategories;

use App\Models\Forums\TopicModel;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class TopicsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    protected $table = 'topics';

    public function run(): void
    {
        $topics = [
            ['name' => 'Food', 'slug' => 'food'],
            ['name' => 'Travel', 'slug' => 'travel'],
            ['name' => 'Mountain', 'slug' => 'mountain'],
            ['name' => 'Rentals', 'slug' => 'rentals'],
            ['name' => 'Shops', 'slug' => 'shops'],
            ['name' => 'Non-Skiing Activities', 'slug' => 'non-skiing-activities'],
        ];

        foreach ($topics as $topicData) {
            TopicModel::updateOrCreate(['slug' => $topicData['slug']], $topicData);
        }
    }
}
