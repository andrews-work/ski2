<?php

namespace Database\Seeders\forumCategories\continents;

use App\Models\Forums\CategoryListModel;
use Illuminate\Database\Seeder;

class SouthAmericaSeeder extends Seeder
{
    public function run()
    {
        // Create South America category
        $southAmerica = CategoryListModel::create([
            'name' => 'South America',
            'description' => 'Ski resorts in South America.',
            'parent_id' => '1',
            'slug' => 'south-america',
            'type' => 'continent',
        ]);

        // Create Argentina category
        $argentina = CategoryListModel::create([
            'name' => 'Argentina',
            'parent_id' => $southAmerica->id,
            'slug' => 'argentina',
            'type' => 'country',
        ]);

        // Create Argentina ski resorts
        CategoryListModel::create([
            'name' => 'Cerro Catedral',
            'parent_id' => $argentina->id,
            'slug' => 'cerro-catedral',
            'type' => 'resort',
        ]);

        CategoryListModel::create([
            'name' => 'La Hoya',
            'parent_id' => $argentina->id,
            'slug' => 'la-hoya',
            'type' => 'resort',
        ]);

        CategoryListModel::create([
            'name' => 'Cerro Castor',
            'parent_id' => $argentina->id,
            'slug' => 'cerro-castor',
            'type' => 'resort',
        ]);

        // Create Chile category
        $chile = CategoryListModel::create([
            'name' => 'Chile',
            'parent_id' => $southAmerica->id,
            'slug' => 'chile',
            'type' => 'country',
        ]);

        // Create Chile ski resorts
        CategoryListModel::create([
            'name' => 'Valle Nevado',
            'parent_id' => $chile->id,
            'slug' => 'valle-nevado',
            'type' => 'resort',
        ]);

        CategoryListModel::create([
            'name' => 'Portillo',
            'parent_id' => $chile->id,
            'slug' => 'portillo',
            'type' => 'resort',
        ]);

        CategoryListModel::create([
            'name' => 'La Parva',
            'parent_id' => $chile->id,
            'slug' => 'la-parva',
            'type' => 'resort',
        ]);

        CategoryListModel::create([
            'name' => 'El Colorado',
            'parent_id' => $chile->id,
            'slug' => 'el-colorado',
            'type' => 'resort',
        ]);
    }
}
