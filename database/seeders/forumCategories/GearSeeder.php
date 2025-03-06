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
            'type' => 'category',
        ]);

        // Skis Categories
        $skis = CategoryListModel::create([
            'name' => 'Skis',
            'parent_id' => $gear->id,
            'slug' => 'skis',
            'type' => 'gear',
        ]);

        CategoryListModel::create([
            'name' => 'Race',
            'parent_id' => $skis->id,
            'slug' => 'race',
            'type' => 'skis',
        ]);

        CategoryListModel::create([
            'name' => 'All Mountain',
            'parent_id' => $skis->id,
            'slug' => 'all-mountain',
            'type' => 'skis',
        ]);

        CategoryListModel::create([
            'name' => 'Park',
            'parent_id' => $skis->id,
            'slug' => 'park',
            'type' => 'skis',
        ]);

        CategoryListModel::create([
            'name' => 'Free Ride',
            'parent_id' => $skis->id,
            'slug' => 'free-ride',
            'type' => 'skis',
        ]);

        CategoryListModel::create([
            'name' => 'Backcountry',
            'parent_id' => $skis->id,
            'slug' => 'backcountry',
            'type' => 'skis',
        ]);

        CategoryListModel::create([
            'name' => 'X-Country',
            'parent_id' => $skis->id,
            'slug' => 'x-country',
            'type' => 'skis',
        ]);

        CategoryListModel::create([
            'name' => 'Big Mountain',
            'parent_id' => $skis->id,
            'slug' => 'big-mountain',
            'type' => 'skis',
        ]);

        CategoryListModel::create([
            'name' => 'Powder',
            'parent_id' => $skis->id,
            'slug' => 'powder',
            'type' => 'skis',
        ]);

        // Snowboards Categories
        $snowboards = CategoryListModel::create([
            'name' => 'Snowboards',
            'parent_id' => $gear->id,
            'slug' => 'snowboards',
            'type' => 'gear',
        ]);

        CategoryListModel::create([
            'name' => 'Split Boards',
            'parent_id' => $snowboards->id,
            'slug' => 'split-boards',
            'type' => 'snowboards',
        ]);

        CategoryListModel::create([
            'name' => 'Powder',
            'parent_id' => $snowboards->id,
            'slug' => 'powder-snowboards',
            'type' => 'snowboards',
        ]);

        CategoryListModel::create([
            'name' => 'Park',
            'parent_id' => $snowboards->id,
            'slug' => 'park-snowboards',
            'type' => 'snowboards',
        ]);

        // Gloves Categories
        $gloves = CategoryListModel::create([
            'name' => 'Gloves',
            'parent_id' => $gear->id,
            'slug' => 'gloves',
            'type' => 'gear',
        ]);

        CategoryListModel::create([
            'name' => 'Inners',
            'parent_id' => $gloves->id,
            'slug' => 'inners',
            'type' => 'gloves',
        ]);

        CategoryListModel::create([
            'name' => 'Outers',
            'parent_id' => $gloves->id,
            'slug' => 'outers',
            'type' => 'gloves',
        ]);

        // Clothes Categories
        $clothes = CategoryListModel::create([
            'name' => 'Clothes',
            'parent_id' => $gear->id,
            'slug' => 'clothes',
            'type' => 'gear',
        ]);

        CategoryListModel::create([
            'name' => 'Socks',
            'parent_id' => $clothes->id,
            'slug' => 'socks',
            'type' => 'clothes',
        ]);

        CategoryListModel::create([
            'name' => 'Jackets',
            'parent_id' => $clothes->id,
            'slug' => 'jackets',
            'type' => 'clothes',
        ]);

        CategoryListModel::create([
            'name' => 'Pants',
            'parent_id' => $clothes->id,
            'slug' => 'pants',
            'type' => 'clothes',
        ]);

        CategoryListModel::create([
            'name' => 'Thermals',
            'parent_id' => $clothes->id,
            'slug' => 'thermals',
            'type' => 'clothes',
        ]);

        CategoryListModel::create([
            'name' => 'Hoodies',
            'parent_id' => $clothes->id,
            'slug' => 'hoodies',
            'type' => 'clothes',
        ]);

        // Boots Categories
        $boots = CategoryListModel::create([
            'name' => 'Boots',
            'parent_id' => $gear->id,
            'slug' => 'boots',
            'type' => 'gear',
        ]);

        CategoryListModel::create([
            'name' => 'Après',
            'parent_id' => $boots->id,
            'slug' => 'apres-boots',
            'type' => 'boots',
        ]);

        CategoryListModel::create([
            'name' => 'Ski',
            'parent_id' => $boots->id,
            'slug' => 'ski-boots',
            'type' => 'boots',
        ]);

        CategoryListModel::create([
            'name' => 'Snowboard',
            'parent_id' => $boots->id,
            'slug' => 'snowboard-boots',
            'type' => 'boots',
        ]);

        // Additional Categories
        CategoryListModel::create([
            'name' => 'Bindings',
            'parent_id' => $gear->id,
            'slug' => 'bindings',
            'type' => 'gear',
        ]);

        CategoryListModel::create([
            'name' => 'Brands',
            'parent_id' => $gear->id,
            'slug' => 'brands',
            'type' => 'gear',
        ]);

        CategoryListModel::create([
            'name' => 'Poles',
            'parent_id' => $gear->id,
            'slug' => 'poles',
            'type' => 'gear',
        ]);

        CategoryListModel::create([
            'name' => 'Goggles',
            'parent_id' => $gear->id,
            'slug' => 'goggles',
            'type' => 'gear',
        ]);
    }
}
