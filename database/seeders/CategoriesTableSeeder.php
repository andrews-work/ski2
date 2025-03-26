<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CategoriesTableSeeder extends Seeder
{
    public function run()
    {
        $categories = [
            ['name' => 'Info', 'slug' => 'info', 'icon' => 'Info'],
            ['name' => 'Hotels', 'slug' => 'hotels', 'icon' => 'Hotel'],
            ['name' => 'Restaurants', 'slug' => 'restaurants', 'icon' => 'Utensils'],
            ['name' => 'Forums', 'slug' => 'forums', 'icon' => 'NotebookPen'],
            ['name' => 'Bars', 'slug' => 'bars', 'icon' => 'Martini'],
            ['name' => 'Events', 'slug' => 'events', 'icon' => 'PartyPopper'],
            ['name' => 'Jobs', 'slug' => 'jobs', 'icon' => 'BriefcaseBusiness'],
            ['name' => 'Marketplace', 'slug' => 'marketplace', 'icon' => 'ShoppingCart'],
            ['name' => 'Businesses', 'slug' => 'businesses', 'icon' => 'Building2'],
            ['name' => 'Weather', 'slug' => 'weather', 'icon' => 'cloudSun'],
        ];

        foreach ($categories as $category) {
            Category::create($category);
        }
    }
}
