<?php

namespace Database\Seeders;

use App\Models\ListingCategoryModel;
use Illuminate\Database\Seeder;

class ListingCategorySeeder extends Seeder
{
    public function run(): void
    {
        $categories = [
            ['name' => 'Kitchen'],
            ['name' => 'Car'],
            ['name' => 'Clothes'],
            ['name' => 'Ski\'s & Boards'],
            ['name' => 'Living Room'],
            ['name' => 'Furniture'],
            ['name' => 'Electronics'],
            ['name' => 'Events'],
        ];

        foreach ($categories as $category) {
            ListingCategoryModel::create($category);
        }
    }
}