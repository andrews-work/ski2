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
        ]);

        CategoryListModel::create([
            'name' => 'Rules',
            'parent_id' => $safety->id,
            'slug' => 'rules',
        ]);

        CategoryListModel::create([
            'name' => 'Avalanche Safety',
            'parent_id' => $safety->id,
            'slug' => 'avalanche-safety',
        ]);

        CategoryListModel::create([
            'name' => 'First Aid',
            'parent_id' => $safety->id,
            'slug' => 'first-aid',
        ]);
    }
}
