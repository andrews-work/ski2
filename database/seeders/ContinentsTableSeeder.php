<?php

namespace Database\Seeders;

use App\Models\Continent;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ContinentsTableSeeder extends Seeder
{
    public function run() {
        $continents = [
            ['name' => 'Europe', 'slug' => 'europe'],
            ['name' => 'North America', 'slug' => 'north-america'],
            ['name' => 'Asia', 'slug' => 'asia'],
            ['name' => 'South America', 'slug' => 'south-america'],
            ['name' => 'Africa', 'slug' => 'africa'],
            ['name' => 'Australia / New Zealand', 'slug' => 'anz'],
            ['name' => 'Middle East', 'slug' => 'middle-east'],
        ];

        foreach ($continents as $continent) {
            Continent::create($continent);
        }
    }
}
