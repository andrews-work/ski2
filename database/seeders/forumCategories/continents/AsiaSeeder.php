<?php

namespace Database\Seeders\forumCategories\continents;

use App\Models\Forums\CategoryListModel;
use Illuminate\Database\Seeder;

class AsiaSeeder extends Seeder
{
    public function run()
    {
        $europe = CategoryListModel::create([
            'name' => 'Asia',
            'description' => 'Ski resorts in Japan.',
            'parent_id' => '1',
            'slug' => 'asia',
        ]);

        $france = CategoryListModel::create([
            'name' => 'Japan',
            'parent_id' => $europe->id,
            'slug' => 'japan',
        ]);

        CategoryListModel::create([
            'name' => 'Hakuba',
            'parent_id' => $france->id,
            'slug' => 'hakuba',
        ]);

        CategoryListModel::create([
            'name' => 'Nozawa Onsen',
            'parent_id' => $france->id,
            'slug' => 'nozawa-onsen',
        ]);

        $italy = CategoryListModel::create([
            'name' => 'South Korea',
            'parent_id' => $europe->id,
            'slug' => 'south-korea',
        ]);

        CategoryListModel::create([
            'name' => 'YongPyong',
            'parent_id' => $italy->id,
            'slug' => 'yongpyong',
        ]);

        CategoryListModel::create([
            'name' => 'High 1',
            'parent_id' => $italy->id,
            'slug' => 'high-1',
        ]);
    }
}
