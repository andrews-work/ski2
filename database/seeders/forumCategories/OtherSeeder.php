<?php

namespace Database\Seeders\forumCategories;

use App\Models\Forums\CategoryListModel;
use Illuminate\Database\Seeder;

class OtherSeeder extends Seeder
{
    public function run(): void
    {
        $other = CategoryListModel::create([
            'name' => 'Other',
            'description' => 'The great debate and other topics',
            'slug' => 'other',
            'type' => 'category',
        ]);

        CategoryListModel::create([
            'name' => 'Suggestions',
            'parent_id' => $other->id,
            'slug' => 'suggestions',
            'type' => 'other',
        ]);

        CategoryListModel::create([
            'name' => 'Ikon Pass',
            'parent_id' => $other->id,
            'slug' => 'ikon-pass',
            'type' => 'other',
        ]);

        CategoryListModel::create([
            'name' => 'Epic Pass',
            'parent_id' => $other->id,
            'slug' => 'epic-pass',
            'type' => 'other',
        ]);

        CategoryListModel::create([
            'name' => 'Independant',
            'parent_id' => $other->id,
            'slug' => 'independant',
            'type' => 'other',
        ]);

        CategoryListModel::create([
            'name' => 'Ikon v Independant v Vail',
            'parent_id' => $other->id,
            'slug' => 'the-great-debate',
            'type' => 'other',
        ]);
    }
}
