<?php

namespace Database\Seeders\forumCategories;

use App\Models\Forums\CategoryListModel;
use Illuminate\Database\Seeder;

class EventsSeeder extends Seeder
{
    public function run()
    {
        $events = CategoryListModel::create([
            'name' => 'Events',
            'description' => 'Discuss skiing events, competitions, and tours.',
            'slug' => 'events',
        ]);

        CategoryListModel::create([
            'name' => 'Free Ride World Tour',
            'parent_id' => $events->id,
            'slug' => 'free-ride-world-tour',
        ]);

        CategoryListModel::create([
            'name' => 'Alpine',
            'parent_id' => $events->id,
            'slug' => 'alpine',
        ]);

        CategoryListModel::create([
            'name' => 'Park',
            'parent_id' => $events->id,
            'slug' => 'park',
        ]);

        CategoryListModel::create([
            'name' => 'X-country',
            'parent_id' => $events->id,
            'slug' => 'x-country',
        ]);
    }
}
