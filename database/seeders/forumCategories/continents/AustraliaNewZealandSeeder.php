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
        ]);

        // Australia
        $australia = CategoryListModel::create([
            'name' => 'Australia',
            'parent_id' => $australiaNZ->id,
            'slug' => 'australia',
        ]);

        // Australian resorts
        CategoryListModel::create([
            'name' => 'Perisher',
            'parent_id' => $australia->id,
            'slug' => 'perisher',
        ]);

        CategoryListModel::create([
            'name' => 'Mt Buller',
            'parent_id' => $australia->id,
            'slug' => 'mt-buller',
        ]);

        CategoryListModel::create([
            'name' => 'Mt Hotham',
            'parent_id' => $australia->id,
            'slug' => 'mt-hotham',
        ]);

        CategoryListModel::create([
            'name' => 'Falls Creek',
            'parent_id' => $australia->id,
            'slug' => 'falls-creek',
        ]);

        CategoryListModel::create([
            'name' => 'Thredbo',
            'parent_id' => $australia->id,
            'slug' => 'thredbo',
        ]);

        CategoryListModel::create([
            'name' => 'Dinner Plain',
            'parent_id' => $australia->id,
            'slug' => 'dinner-plain',
        ]);

        CategoryListModel::create([
            'name' => 'Charlotte Pass',
            'parent_id' => $australia->id,
            'slug' => 'charlotte-pass',
        ]);

        CategoryListModel::create([
            'name' => 'Lake Mountain',
            'parent_id' => $australia->id,
            'slug' => 'lake-mountain',
        ]);

        CategoryListModel::create([
            'name' => 'Selwyn Snow Resort',
            'parent_id' => $australia->id,
            'slug' => 'selwyn-snow-resort',
        ]);

        CategoryListModel::create([
            'name' => 'Baw Baw',
            'parent_id' => $australia->id,
            'slug' => 'baw-baw',
        ]);

        // New Zealand
        $newZealand = CategoryListModel::create([
            'name' => 'New Zealand',
            'parent_id' => $australiaNZ->id,
            'slug' => 'new-zealand',
        ]);

        // New Zealand resorts
        CategoryListModel::create([
            'name' => 'Remarkables',
            'parent_id' => $newZealand->id,
            'slug' => 'remarkables',
        ]);

        CategoryListModel::create([
            'name' => 'Coronet Peak',
            'parent_id' => $newZealand->id,
            'slug' => 'coronet-peak',
        ]);

        CategoryListModel::create([
            'name' => 'Cardrona',
            'parent_id' => $newZealand->id,
            'slug' => 'cardrona',
        ]);

        CategoryListModel::create([
            'name' => 'Treble Cone',
            'parent_id' => $newZealand->id,
            'slug' => 'treble-cone',
        ]);

        CategoryListModel::create([
            'name' => 'Turoa',
            'parent_id' => $newZealand->id,
            'slug' => 'turoa',
        ]);

        CategoryListModel::create([
            'name' => 'Whakapapa',
            'parent_id' => $newZealand->id,
            'slug' => 'whakapapa',
        ]);

        CategoryListModel::create([
            'name' => 'Mt Ruapehu',
            'parent_id' => $newZealand->id,
            'slug' => 'mt-ruapehu',
        ]);

        CategoryListModel::create([
            'name' => 'Broken River',
            'parent_id' => $newZealand->id,
            'slug' => 'broken-river',
        ]);

        CategoryListModel::create([
            'name' => 'Craigieburn Valley',
            'parent_id' => $newZealand->id,
            'slug' => 'craigieburn-valley',
        ]);

        CategoryListModel::create([
            'name' => 'Mount Olympus',
            'parent_id' => $newZealand->id,
            'slug' => 'mount-olympus',
        ]);

        CategoryListModel::create([
            'name' => 'The Snow Farm',
            'parent_id' => $newZealand->id,
            'slug' => 'the-snow-farm',
        ]);

        CategoryListModel::create([
            'name' => 'Porters',
            'parent_id' => $newZealand->id,
            'slug' => 'porters',
        ]);

        CategoryListModel::create([
            'name' => 'Cardrona Alpine Resort',
            'parent_id' => $newZealand->id,
            'slug' => 'cardrona-alpine-resort',
        ]);

        CategoryListModel::create([
            'name' => 'Mt Cheeseman',
            'parent_id' => $newZealand->id,
            'slug' => 'mt-cheeseman',
        ]);

        CategoryListModel::create([
            'name' => 'The Remarkables Ski Area',
            'parent_id' => $newZealand->id,
            'slug' => 'the-remarkables-ski-area',
        ]);

        CategoryListModel::create([
            'name' => 'Rainbow Ski Area',
            'parent_id' => $newZealand->id,
            'slug' => 'rainbow-ski-area',
        ]);
    }
}
