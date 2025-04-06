<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CategoriesTableSeeder extends Seeder
{
    public function run(): void
    {
        $categories = [
            // Town categories
            [
                'name' => 'General',
                'slug' => 'general',
                'icon' => 'Info',
                'type' => 'town'
            ],
            [
                'name' => 'Weather',
                'slug' => 'weather',
                'icon' => 'CloudSun',
                'type' => 'town'
            ],
            [
                'name' => 'Resorts',
                'slug' => 'resorts',
                'icon' => 'CableCar',
                'type' => 'town'
            ],
            [
                'name' => 'Backcountry',
                'slug' => 'backcountry',
                'icon' => 'TentTree',
                'type' => 'town'
            ],
            [
                'name' => 'Forums',
                'slug' => 'forums',
                'icon' => 'NotebookPen',
                'type' => 'town'
            ],
            [
                'name' => 'Arts',
                'slug' => 'arts',
                'icon' => 'Brush',
                'type' => 'town'
            ],
            [
                'name' => 'Activities',
                'slug' => 'activities',
                'icon' => 'Axe',
                'type' => 'town'
            ],
            [
                'name' => 'Accomodation',
                'slug' => 'accomodation',
                'icon' => 'Hotel',
                'type' => 'town'
            ],
            [
                'name' => 'Food & Drink',
                'slug' => 'food-drink',
                'icon' => 'Utensils',
                'type' => 'town'
            ],
            [
                'name' => 'Transport',
                'slug' => 'transport',
                'icon' => 'Bus',
                'type' => 'town'
            ],
            [
                'name' => 'Jobs',
                'slug' => 'jobs',
                'icon' => 'BriefcaseBusiness',
                'type' => 'town'
            ],
            [
                'name' => 'Marketplace',
                'slug' => 'marketplace',
                'icon' => 'ShoppingCart',
                'type' => 'town'
            ],
            [
                'name' => 'Companies',
                'slug' => 'companies',
                'icon' => 'Building2',
                'type' => 'town'
            ],
            [
                'name' => 'Events',
                'slug' => 'events',
                'icon' => 'PartyPopper',
                'type' => 'town'
            ],
            [
                'name' => 'Fitness',
                'slug' => 'health',
                'icon' => 'Dumbbell',
                'type' => 'town'
            ],
            [
                'name' => 'Content',
                'slug' => 'content',
                'icon' => 'Camera',
                'type' => 'town'
            ],
            [
                'name' => 'Rentals',
                'slug' => 'rentals',
                'icon' => 'DollarSign',
                'type' => 'town'
            ],
            [
                'name' => 'Maps',
                'slug' => 'maps',
                'icon' => 'MapPinned',
                'type' => 'town'
            ],

            // Resort categories
            [
                'name' => 'Info',
                'slug' => 'info',
                'icon' => 'Info',
                'type' => 'resort'
            ],
            [
                'name' => 'Food & Drink',
                'slug' => 'food-drink',
                'icon' => 'Utensils',
                'type' => 'resort'
            ],
            [
                'name' => 'Mountain',
                'slug' => 'mountains',
                'icon' => 'Mountain',
                'type' => 'resort'
            ],
            [
                'name' => 'Weather',
                'slug' => 'weather',
                'icon' => 'CloudSun',
                'type' => 'resort'
            ],
            [
                'name' => 'Chairlifts',
                'slug' => 'chairlifts',
                'icon' => 'ArrowUpFromLine',
                'type' => 'resort'
            ],
            [
                'name' => 'Ski Patrol',
                'slug' => 'patrol',
                'icon' => 'Shield',
                'type' => 'resort'
            ],
            [
                'name' => 'Events',
                'slug' => 'events',
                'icon' => 'PartyPopper',
                'type' => 'resort'
            ],
            [
                'name' => 'Ski Passes',
                'slug' => 'ski-pass',
                'icon' => 'Ticket',
                'type' => 'resort'
            ],
            [
                'name' => 'Terrain',
                'slug' => 'terrain',
                'icon' => 'MountainSnow',
                'type' => 'resort'
            ],
            [
                'name' => 'Parking',
                'slug' => 'parking',
                'icon' => 'ParkingSquare',
                'type' => 'resort'
            ],
            [
                'name' => 'Storage',
                'slug' => 'storage',
                'icon' => 'Lock',
                'type' => 'resort'
            ],
            [
                'name' => 'Shops',
                'slug' => 'shops',
                'icon' => 'ShoppingBag',
                'type' => 'resort'
            ],
            [
                'name' => 'Forums',
                'slug' => 'forums',
                'icon' => 'NotebookPen',
                'type' => 'resort'
            ],
            [
                'name' => 'Ski School',
                'slug' => 'school',
                'icon' => 'GraduationCap',
                'type' => 'resort'
            ],
            [
                'name' => 'Maps',
                'slug' => 'maps',
                'icon' => 'MapPinned',
                'type' => 'resort'
            ],

            // Mountain categories
            [
                'name' => 'Info',
                'slug' => 'info',
                'icon' => 'Info',
                'type' => 'mountain'
            ],
            [
                'name' => 'Chairlifts',
                'slug' => 'chairs',
                'icon' => 'ArrowUpFromLine',
                'type' => 'mountain'
            ],
            [
                'name' => 'Bathrooms',
                'slug' => 'bathrooms',
                'icon' => 'Toilet',
                'type' => 'mountain'
            ],
            [
                'name' => 'Events',
                'slug' => 'events',
                'icon' => 'PartyPopper',
                'type' => 'mountain'
            ],
            [
                'name' => 'Food',
                'slug' => 'food',
                'icon' => 'Utensils',
                'type' => 'mountain'
            ],
            [
                'name' => 'Booter',
                'slug' => 'find-my-booter',
                'icon' => 'Jump',
                'type' => 'mountain'
            ],
            [
                'name' => 'Weather',
                'slug' => 'weather',
                'icon' => 'CloudSun',
                'type' => 'mountain'
            ],
            [
                'name' => 'Bars',
                'slug' => 'bars',
                'icon' => 'Martini',
                'type' => 'mountain'
            ],
            [
                'name' => 'Storage',
                'slug' => 'storage',
                'icon' => 'Lock',
                'type' => 'mountain'
            ],
            [
                'name' => 'Travel',
                'slug' => 'travel',
                'icon' => 'Bus',
                'type' => 'mountain'
            ],
            [
                'name' => 'Terrain',
                'slug' => 'terrain',
                'icon' => 'MountainSnow',
                'type' => 'mountain'
            ]
        ];

        foreach ($categories as $category) {
            Category::create($category);
        }
    }
}
