<?php

namespace Database\Seeders\forumCategories\continents;

use App\Models\Forums\CategoryListModel;
use Illuminate\Database\Seeder;

class AustraliaNewZealandSeeder extends Seeder
{
    public function run()
    {
        $australiaNZ = CategoryListModel::create([
            'name' => 'Australia / New Zealand',
            'description' => 'Ski resorts in Australia and New Zealand.',
            'parent_id' => '1',
            'slug' => 'australia-new-zealand',
            'type' => 'continent',
        ]);

        // Australia
        $australia = CategoryListModel::create([
            'name' => 'Australia',
            'parent_id' => $australiaNZ->id,
            'slug' => 'australia',
            'type' => 'country',
        ]);

        // Australian resorts
        CategoryListModel::create([
            'name' => 'Perisher',
            'parent_id' => $australia->id,
            'slug' => 'perisher',
            'type' => 'resort',
        ]);

        CategoryListModel::create([
            'name' => 'Mt Buller',
            'parent_id' => $australia->id,
            'slug' => 'mt-buller',
            'type' => 'resort',
        ]);

        CategoryListModel::create([
            'name' => 'Mt Hotham',
            'parent_id' => $australia->id,
            'slug' => 'mt-hotham',
            'type' => 'resort',
        ]);

        CategoryListModel::create([
            'name' => 'Falls Creek',
            'parent_id' => $australia->id,
            'slug' => 'falls-creek',
            'type' => 'resort',
        ]);

        CategoryListModel::create([
            'name' => 'Thredbo',
            'parent_id' => $australia->id,
            'slug' => 'thredbo',
            'type' => 'resort',
        ]);

        CategoryListModel::create([
            'name' => 'Dinner Plain',
            'parent_id' => $australia->id,
            'slug' => 'dinner-plain',
            'type' => 'resort',
        ]);

        CategoryListModel::create([
            'name' => 'Charlotte Pass',
            'parent_id' => $australia->id,
            'slug' => 'charlotte-pass',
            'type' => 'resort',
        ]);

        CategoryListModel::create([
            'name' => 'Lake Mountain',
            'parent_id' => $australia->id,
            'slug' => 'lake-mountain',
            'type' => 'resort',
        ]);

        CategoryListModel::create([
            'name' => 'Selwyn Snow Resort',
            'parent_id' => $australia->id,
            'slug' => 'selwyn-snow-resort',
            'type' => 'resort',
        ]);

        CategoryListModel::create([
            'name' => 'Baw Baw',
            'parent_id' => $australia->id,
            'slug' => 'baw-baw',
            'type' => 'resort',
        ]);

        // New Zealand
        $newZealand = CategoryListModel::create([
            'name' => 'New Zealand',
            'parent_id' => $australiaNZ->id,
            'slug' => 'new-zealand',
            'type' => 'country',
        ]);

        // New Zealand resorts
        CategoryListModel::create([
            'name' => 'Remarkables',
            'parent_id' => $newZealand->id,
            'slug' => 'remarkables',
            'type' => 'resort',
        ]);

        CategoryListModel::create([
            'name' => 'Coronet Peak',
            'parent_id' => $newZealand->id,
            'slug' => 'coronet-peak',
            'type' => 'resort',
        ]);

        CategoryListModel::create([
            'name' => 'Cardrona',
            'parent_id' => $newZealand->id,
            'slug' => 'cardrona',
            'type' => 'resort',
        ]);

        CategoryListModel::create([
            'name' => 'Treble Cone',
            'parent_id' => $newZealand->id,
            'slug' => 'treble-cone',
            'type' => 'resort',
        ]);

        CategoryListModel::create([
            'name' => 'Turoa',
            'parent_id' => $newZealand->id,
            'slug' => 'turoa',
            'type' => 'resort',
        ]);

        CategoryListModel::create([
            'name' => 'Whakapapa',
            'parent_id' => $newZealand->id,
            'slug' => 'whakapapa',
            'type' => 'resort',
        ]);

        CategoryListModel::create([
            'name' => 'Mt Ruapehu',
            'parent_id' => $newZealand->id,
            'slug' => 'mt-ruapehu',
            'type' => 'resort',
        ]);

        CategoryListModel::create([
            'name' => 'Broken River',
            'parent_id' => $newZealand->id,
            'slug' => 'broken-river',
            'type' => 'resort',
        ]);

        CategoryListModel::create([
            'name' => 'Craigieburn Valley',
            'parent_id' => $newZealand->id,
            'slug' => 'craigieburn-valley',
            'type' => 'resort',
        ]);

        CategoryListModel::create([
            'name' => 'Mount Olympus',
            'parent_id' => $newZealand->id,
            'slug' => 'mount-olympus',
            'type' => 'resort',
        ]);

        CategoryListModel::create([
            'name' => 'The Snow Farm',
            'parent_id' => $newZealand->id,
            'slug' => 'the-snow-farm',
            'type' => 'resort',
        ]);

        CategoryListModel::create([
            'name' => 'Porters',
            'parent_id' => $newZealand->id,
            'slug' => 'porters',
            'type' => 'resort',
        ]);

        CategoryListModel::create([
            'name' => 'Cardrona Alpine Resort',
            'parent_id' => $newZealand->id,
            'slug' => 'cardrona-alpine-resort',
            'type' => 'resort',
        ]);

        CategoryListModel::create([
            'name' => 'Mt Cheeseman',
            'parent_id' => $newZealand->id,
            'slug' => 'mt-cheeseman',
            'type' => 'resort',
        ]);

        CategoryListModel::create([
            'name' => 'The Remarkables Ski Area',
            'parent_id' => $newZealand->id,
            'slug' => 'the-remarkables-ski-area',
            'type' => 'resort',
        ]);

        CategoryListModel::create([
            'name' => 'Rainbow Ski Area',
            'parent_id' => $newZealand->id,
            'slug' => 'rainbow-ski-area',
            'type' => 'resort',
        ]);
    }
}
