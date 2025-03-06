<?php

namespace Database\Seeders\forumCategories;

use App\Models\Forums\CategoryListModel;
use Illuminate\Database\Seeder;

class TechniqueSeeder extends Seeder
{
    public function run()
    {
        $technique = CategoryListModel::create([
            'name' => 'Technique',
            'description' => 'Learn and improve your skiing techniques.',
            'slug' => 'technique',
            'type' => 'category',
        ]);

        CategoryListModel::create([
            'name' => 'Groomers',
            'parent_id' => $technique->id,
            'slug' => 'groomers',
            'type' => 'technique',
        ]);

        CategoryListModel::create([
            'name' => 'Park',
            'parent_id' => $technique->id,
            'slug' => 'park',
            'type' => 'technique',
        ]);

        CategoryListModel::create([
            'name' => 'Trees',
            'parent_id' => $technique->id,
            'slug' => 'trees',
            'type' => 'technique',
        ]);

        CategoryListModel::create([
            'name' => 'Powder',
            'parent_id' => $technique->id,
            'slug' => 'powder',
            'type' => 'technique',
        ]);

        CategoryListModel::create([
            'name' => 'Cliffs',
            'parent_id' => $technique->id,
            'slug' => 'cliffs',
            'type' => 'technique',
        ]);

        CategoryListModel::create([
            'name' => 'Backcountry',
            'parent_id' => $technique->id,
            'slug' => 'backcountry',
            'type' => 'technique',
        ]);

        CategoryListModel::create([
            'name' => 'Crosscountry',
            'parent_id' => $technique->id,
            'slug' => 'crosscountry',
            'type' => 'technique',
        ]);

        CategoryListModel::create([
            'name' => 'Race',
            'parent_id' => $technique->id,
            'slug' => 'race',
            'type' => 'technique',
        ]);
    }
}
