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
            'name' => 'Ikon',
            'parent_id' => $other->id,
            'slug' => 'icon',
            'type' => 'other',
        ]);

        CategoryListModel::create([
            'name' => 'Vail',
            'parent_id' => $other->id,
            'slug' => 'vail',
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
