<?php

namespace Database\Seeders;

use App\Models\Forums\CategoryListModel;
use Illuminate\Database\Seeder;
use Database\Seeders\forumCategories\ResortsSeeder;
use Database\Seeders\forumCategories\GearSeeder;
use Database\Seeders\forumCategories\EventsSeeder;
use Database\Seeders\forumCategories\TechniqueSeeder;
use Database\Seeders\forumCategories\SafetySeeder;
use Database\Seeders\forumCategories\OtherSeeder;

class CategoryListSeeder extends Seeder
{

    protected $model = CategoryListModel::class;

    public function run(): void
    {
        $this->call([
            ResortsSeeder::class,
            GearSeeder::class,
            EventsSeeder::class,
            TechniqueSeeder::class,
            SafetySeeder::class,
            OtherSeeder::class,
        ]);
    }
}
