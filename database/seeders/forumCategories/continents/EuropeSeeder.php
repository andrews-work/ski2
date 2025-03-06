<?php

namespace Database\Seeders\forumCategories\continents;

use App\Models\Forums\CategoryListModel;
use Illuminate\Database\Seeder;

class EuropeSeeder extends Seeder
{
    public function run()
    {
        $europe = CategoryListModel::create([
            'name' => 'Europe',
            'description' => 'Ski resorts in Europe.',
            'parent_id' => '1',
            'slug' => 'europe',
            'type' => 'continent',
        ]);

        $france = CategoryListModel::create([
            'name' => 'France',
            'parent_id' => $europe->id,
            'slug' => 'france',
            'type' => 'country',
        ]);

        CategoryListModel::create([
            'name' => 'Chamonix',
            'parent_id' => $france->id,
            'slug' => 'chamonix',
            'type' => 'resort',
        ]);

        CategoryListModel::create([
            'name' => 'Les Arcs',
            'parent_id' => $france->id,
            'slug' => 'les-arcs',
            'type' => 'resort',
        ]);

        $italy = CategoryListModel::create([
            'name' => 'Italy',
            'parent_id' => $europe->id,
            'slug' => 'italy',
            'type' => 'country',
        ]);

        CategoryListModel::create([
            'name' => 'Cortina d\'Ampezzo',
            'parent_id' => $italy->id,
            'slug' => 'cortina-dampezzo',
            'type' => 'resort',
        ]);

        CategoryListModel::create([
            'name' => 'Val Gardena',
            'parent_id' => $italy->id,
            'slug' => 'val-gardena',
            'type' => 'resort',
        ]);
    }
}
