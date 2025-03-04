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
        ]);

        $france = CategoryListModel::create([
            'name' => 'France',
            'parent_id' => $europe->id,
            'slug' => 'france',
        ]);

        CategoryListModel::create([
            'name' => 'Chamonix',
            'parent_id' => $france->id,
            'slug' => 'chamonix',
        ]);

        CategoryListModel::create([
            'name' => 'Les Arcs',
            'parent_id' => $france->id,
            'slug' => 'les-arcs',
        ]);

        $italy = CategoryListModel::create([
            'name' => 'Italy',
            'parent_id' => $europe->id,
            'slug' => 'italy',
        ]);

        CategoryListModel::create([
            'name' => 'Cortina d\'Ampezzo',
            'parent_id' => $italy->id,
            'slug' => 'cortina-dampezzo',
        ]);

        CategoryListModel::create([
            'name' => 'Val Gardena',
            'parent_id' => $italy->id,
            'slug' => 'val-gardena',
        ]);
    }
}
