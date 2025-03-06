<?php

namespace Database\Seeders\forumCategories\continents;

use App\Models\Forums\CategoryListModel;
use Illuminate\Database\Seeder;

class NorthAmericaSeeder extends Seeder
{
    public function run()
    {
        $northAmerica = CategoryListModel::create([
            'name' => 'North America',
            'description' => 'Ski resorts in North America.',
            'parent_id' => '1',
            'slug' => 'north-america',
            'type' => 'continent',
        ]);

        $usa = CategoryListModel::create([
            'name' => 'USA',
            'parent_id' => $northAmerica->id,
            'slug' => 'usa',
            'type' => 'country',
        ]);

        CategoryListModel::create([
            'name' => 'Aspen',
            'parent_id' => $usa->id,
            'slug' => 'aspen',
            'type' => 'resort',
        ]);

        CategoryListModel::create([
            'name' => 'Park City',
            'parent_id' => $usa->id,
            'slug' => 'park-city',
            'type' => 'resort',
        ]);

        $canada = CategoryListModel::create([
            'name' => 'Canada',
            'parent_id' => $northAmerica->id,
            'slug' => 'canada',
            'type' => 'country',
        ]);

        CategoryListModel::create([
            'name' => 'Whistler',
            'parent_id' => $canada->id,
            'slug' => 'whistler',
            'type' => 'resort',
        ]);

        CategoryListModel::create([
            'name' => 'Banff',
            'parent_id' => $canada->id,
            'slug' => 'banff',
            'type' => 'resort',
        ]);
    }
}
