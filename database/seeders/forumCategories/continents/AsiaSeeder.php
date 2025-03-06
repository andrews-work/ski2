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
            'type' => 'continent',
        ]);

        $france = CategoryListModel::create([
            'name' => 'Japan',
            'parent_id' => $europe->id,
            'slug' => 'japan',
            'type' => 'country',
        ]);

        CategoryListModel::create([
            'name' => 'Hakuba',
            'parent_id' => $france->id,
            'slug' => 'hakuba',
            'type' => 'resort',
        ]);

        CategoryListModel::create([
            'name' => 'Nozawa Onsen',
            'parent_id' => $france->id,
            'slug' => 'nozawa-onsen',
            'type' => 'resort',
        ]);

        $italy = CategoryListModel::create([
            'name' => 'South Korea',
            'parent_id' => $europe->id,
            'slug' => 'south-korea',
            'type' => 'country',
        ]);

        CategoryListModel::create([
            'name' => 'YongPyong',
            'parent_id' => $italy->id,
            'slug' => 'yongpyong',
            'type' => 'resort',
        ]);

        CategoryListModel::create([
            'name' => 'High 1',
            'parent_id' => $italy->id,
            'slug' => 'high-1',
            'type' => 'resort',
        ]);
    }
}
