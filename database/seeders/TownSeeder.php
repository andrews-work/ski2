<?php

namespace Database\Seeders;

use App\Models\State;
use App\Models\Town;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class TownSeeder extends Seeder
{
    public function run(): void
    {
        $bc = State::where('code', 'BC')->first();
        $alberta = State::where('code', 'AB')->first();
        $colorado = State::where('code', 'CO')->first();

        $towns = [
            // British Columbia
            [
                'name' => 'Vancouver',
                'slug' => 'vancouver',
                // 'location' => 'Coastal',
                'elevation' => 0,
                'state_id' => $bc->id,
            ],
            [
                'name' => 'Whistler',
                'slug' => 'whistler',
                // 'location' => 'Coast Mountains',
                'elevation' => 670,
                'state_id' => $bc->id,
            ],

            // Alberta
            [
                'name' => 'Banff',
                'slug' => 'banff',
                // 'location' => 'Rocky Mountains',
                'elevation' => 1383,
                'state_id' => $alberta->id,
            ],

            // Colorado
            [
                'name' => 'Vail',
                'slug' => 'vail',
                // 'location' => 'Rocky Mountains',
                'elevation' => 2445,
                'state_id' => $colorado->id,
            ],
            [
                'name' => 'Breckenridge',
                'slug' => 'breckenridge',
                // 'location' => 'Rocky Mountains',
                'elevation' => 2926,
                'state_id' => $colorado->id,
            ],
        ];

        foreach ($towns as $town) {
            Town::firstOrCreate(
                ['slug' => $town['slug']],
                $town
            );
        }
    }
}
