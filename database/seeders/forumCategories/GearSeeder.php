<?php

namespace Database\Seeders\forumCategories;

use App\Models\Forums\CategoryListModel;
use Illuminate\Database\Seeder;

class GearSeeder extends Seeder
{
    public function run()
    {
        $gear = CategoryListModel::create([
            'name' => 'Gear',
            'description' => 'Discuss ski and snowboard gear, brands, and equipment.',
            'slug' => 'gear',
        ]);

        // Skis Categories
        $skis = CategoryListModel::create([
            'name' => 'Skis',
            'parent_id' => $gear->id,
            'slug' => 'skis',
        ]);

        CategoryListModel::create([
            'name' => 'Race',
            'parent_id' => $skis->id,
            'slug' => 'race',
        ]);

        CategoryListModel::create([
            'name' => 'All Mountain',
            'parent_id' => $skis->id,
            'slug' => 'all-mountain',
        ]);

        CategoryListModel::create([
            'name' => 'Park',
            'parent_id' => $skis->id,
            'slug' => 'park',
        ]);

        CategoryListModel::create([
            'name' => 'Free Ride',
            'parent_id' => $skis->id,
            'slug' => 'free-ride',
        ]);

        CategoryListModel::create([
            'name' => 'Backcountry',
            'parent_id' => $skis->id,
            'slug' => 'backcountry',
        ]);

        CategoryListModel::create([
            'name' => 'X-Country',
            'parent_id' => $skis->id,
            'slug' => 'x-country',
        ]);

        CategoryListModel::create([
            'name' => 'Big Mountain',
            'parent_id' => $skis->id,
            'slug' => 'big-mountain',
        ]);

        CategoryListModel::create([
            'name' => 'Powder',
            'parent_id' => $skis->id,
            'slug' => 'powder',
        ]);

        // Snowboards Categories
        $snowboards = CategoryListModel::create([
            'name' => 'Snowboards',
            'parent_id' => $gear->id,
            'slug' => 'snowboards',
        ]);

        CategoryListModel::create([
            'name' => 'Split Boards',
            'parent_id' => $snowboards->id,
            'slug' => 'split-boards',
        ]);

        CategoryListModel::create([
            'name' => 'Powder',
            'parent_id' => $snowboards->id,
            'slug' => 'powder-snowboards',
        ]);

        CategoryListModel::create([
            'name' => 'Park',
            'parent_id' => $snowboards->id,
            'slug' => 'park-snowboards',
        ]);

        // Gloves Categories
        $gloves = CategoryListModel::create([
            'name' => 'Gloves',
            'parent_id' => $gear->id,
            'slug' => 'gloves',
        ]);

        CategoryListModel::create([
            'name' => 'Inners',
            'parent_id' => $gloves->id,
            'slug' => 'inners',
        ]);

        CategoryListModel::create([
            'name' => 'Outers',
            'parent_id' => $gloves->id,
            'slug' => 'outers',
        ]);

        // Clothes Categories
        $clothes = CategoryListModel::create([
            'name' => 'Clothes',
            'parent_id' => $gear->id,
            'slug' => 'clothes',
        ]);

        CategoryListModel::create([
            'name' => 'Socks',
            'parent_id' => $clothes->id,
            'slug' => 'socks',
        ]);

        CategoryListModel::create([
            'name' => 'Jackets',
            'parent_id' => $clothes->id,
            'slug' => 'jackets',
        ]);

        CategoryListModel::create([
            'name' => 'Pants',
            'parent_id' => $clothes->id,
            'slug' => 'pants',
        ]);

        CategoryListModel::create([
            'name' => 'Thermals',
            'parent_id' => $clothes->id,
            'slug' => 'thermals',
        ]);

        CategoryListModel::create([
            'name' => 'Hoodies',
            'parent_id' => $clothes->id,
            'slug' => 'hoodies',
        ]);

        // Boots Categories
        $boots = CategoryListModel::create([
            'name' => 'Boots',
            'parent_id' => $gear->id,
            'slug' => 'boots',
        ]);

        CategoryListModel::create([
            'name' => 'Après',
            'parent_id' => $boots->id,
            'slug' => 'apres-boots',
        ]);

        CategoryListModel::create([
            'name' => 'Ski',
            'parent_id' => $boots->id,
            'slug' => 'ski-boots',
        ]);

        CategoryListModel::create([
            'name' => 'Snowboard',
            'parent_id' => $boots->id,
            'slug' => 'snowboard-boots',
        ]);

        // Additional Categories
        CategoryListModel::create([
            'name' => 'Bindings',
            'parent_id' => $gear->id,
            'slug' => 'bindings',
        ]);

        CategoryListModel::create([
            'name' => 'Brands',
            'parent_id' => $gear->id,
            'slug' => 'brands',
        ]);

        CategoryListModel::create([
            'name' => 'Poles',
            'parent_id' => $gear->id,
            'slug' => 'poles',
        ]);

        CategoryListModel::create([
            'name' => 'Goggles',
            'parent_id' => $gear->id,
            'slug' => 'goggles',
        ]);
    }
}
