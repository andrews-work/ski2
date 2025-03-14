<?php

namespace Database\Seeders\forumCategories;

use App\Models\Forums\CategoryListModel;
use Illuminate\Database\Seeder;

class SafetySeeder extends Seeder
{
    public function run()
    {
        $safety = CategoryListModel::create([
            'name' => 'Safety',
            'description' => 'Learn and discuss safety rules and best practices.',
            'slug' => 'safety',
            'type' => 'category',
        ]);

        CategoryListModel::create([
            'name' => 'Mountain Safety',
            'parent_id' => $safety->id,
            'slug' => 'mountain-safety',
            'type' => 'safety',
        ]);

        CategoryListModel::create([
            'name' => 'Avalanche Safety',
            'parent_id' => $safety->id,
            'slug' => 'avalanche-safety',
            'type' => 'safety',
        ]);
        CategoryListModel::create([
            'name' => 'Resort Safety',
            'parent_id' => $safety->id,
            'slug' => 'resort-safety',
            'type' => 'safety',
        ]);
        CategoryListModel::create([
            'name' => 'First Aid',
            'parent_id' => $safety->id,
            'slug' => 'first-aid',
            'type' => 'safety',
        ]);
        CategoryListModel::create([
            'name' => 'Equipment Safety',
            'parent_id' => $safety->id,
            'slug' => 'equipment-safety',
            'type' => 'safety',
        ]);
        CategoryListModel::create([
            'name' => 'Weather',
            'parent_id' => $safety->id,
            'slug' => 'weather',
            'type' => 'safety',
        ]);
    }

}
