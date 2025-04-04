<?php

namespace Database\Seeders;

use App\Models\Country;
use App\Models\State;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class StateSeeder extends Seeder
{
    public function run(): void
    {
        $canada = Country::where('name', 'Canada')->first();
        $usa = Country::where('name', 'United States')->first();

        $states = [
            // Canada
            [
                'name' => 'British Columbia',
                'code' => 'BC',
                'slug' => 'british-columbia',
                'country_id' => $canada->id,
                'timezone' => 'America/Vancouver',
            ],
            [
                'name' => 'Alberta',
                'code' => 'AB',
                'slug' => 'alberta',
                'country_id' => $canada->id,
                'timezone' => 'America/Edmonton',
            ],

            // USA
            [
                'name' => 'Colorado',
                'code' => 'CO',
                'slug' => 'colorado',
                'country_id' => $usa->id,
                'timezone' => 'America/Denver',
            ],
            [
                'name' => 'Utah',
                'code' => 'UT',
                'slug' => 'utah',
                'country_id' => $usa->id,
                'timezone' => 'America/Denver',
            ],
        ];

        foreach ($states as $state) {
            State::firstOrCreate(
                ['slug' => $state['slug']],
                $state
            );
        }
    }
}
