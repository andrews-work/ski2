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
        ]);

        $usa = CategoryListModel::create([
            'name' => 'USA',
            'parent_id' => $northAmerica->id,
            'slug' => 'usa',
        ]);

        CategoryListModel::create([
            'name' => 'Aspen',
            'parent_id' => $usa->id,
            'slug' => 'aspen',
        ]);

        CategoryListModel::create([
            'name' => 'Park City',
            'parent_id' => $usa->id,
            'slug' => 'park-city',
        ]);

        $canada = CategoryListModel::create([
            'name' => 'Canada',
            'parent_id' => $northAmerica->id,
            'slug' => 'canada',
        ]);

        CategoryListModel::create([
            'name' => 'Whistler',
            'parent_id' => $canada->id,
            'slug' => 'whistler',
        ]);

        CategoryListModel::create([
            'name' => 'Banff',
            'parent_id' => $canada->id,
            'slug' => 'banff',
        ]);
    }
}
