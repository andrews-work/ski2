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
        ]);

        CategoryListModel::create([
            'name' => 'Groomers',
            'parent_id' => $technique->id,
            'slug' => 'groomers',
        ]);

        CategoryListModel::create([
            'name' => 'Park',
            'parent_id' => $technique->id,
            'slug' => 'park',
        ]);

        CategoryListModel::create([
            'name' => 'Trees',
            'parent_id' => $technique->id,
            'slug' => 'trees',
        ]);

        CategoryListModel::create([
            'name' => 'Powder',
            'parent_id' => $technique->id,
            'slug' => 'powder',
        ]);

        CategoryListModel::create([
            'name' => 'Cliffs',
            'parent_id' => $technique->id,
            'slug' => 'cliffs',
        ]);

        CategoryListModel::create([
            'name' => 'Backcountry',
            'parent_id' => $technique->id,
            'slug' => 'backcountry',
        ]);

        CategoryListModel::create([
            'name' => 'Crosscountry',
            'parent_id' => $technique->id,
            'slug' => 'crosscountry',
        ]);

        CategoryListModel::create([
            'name' => 'Race',
            'parent_id' => $technique->id,
            'slug' => 'race',
        ]);
    }
}
