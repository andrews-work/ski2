<?php

namespace Database\Seeders;

use App\Models\Resort;
use App\Models\Town;
use Illuminate\Database\Seeder;

class ResortsSeeder extends Seeder
{
    public function run(): void
    {
        $towns = [
            'whistler' => Town::where('slug', 'whistler')->first(),
            'vancouver' => Town::where('slug', 'vancouver')->first(),
            'banff' => Town::where('slug', 'banff')->first(),
            'vail' => Town::where('slug', 'vail')->first(),
            'breckenridge' => Town::where('slug', 'breckenridge')->first(),
        ];

        $resorts = [
            // Whistler
            [
                'name' => 'Whistler Blackcomb',
                'slug' => 'whistler-blackcomb',
                'town_id' => $towns['whistler']->id,
                'latitude' => 50.1163,
                'longitude' => -122.9574,
                'image_url' => 'http://agnarchy.com/wp-content/uploads/2016/08/Winter-Dual-Mountain-Village-Evening-Bluebird-Lights-DavidMcColm-26390.jpg',
                'open' => '08:30:00',
                'close' => '16:00:00',
                'start' => '2023-11-23',
                'end' => '2024-05-27',
                'base_elevation' => 675,
            ],

            // Vancouver
            [
                'name' => 'Grouse Mountain',
                'slug' => 'grouse-mountain',
                'town_id' => $towns['vancouver']->id,
                'latitude' => 49.3803,
                'longitude' => -123.0827,
                'image_url' => 'http://example.com/grouse.jpg',
                'open' => '09:00:00',
                'close' => '22:00:00',
                'start' => '2023-12-01',
                'end' => '2024-04-15',
                'base_elevation' => 274,
            ],
            [
                'name' => 'Mount Seymour',
                'slug' => 'mount-seymour',
                'town_id' => $towns['vancouver']->id,
                'latitude' => 49.3949,
                'longitude' => -122.9396,
                'image_url' => 'http://example.com/seymour.jpg',
                'open' => '09:00:00',
                'close' => '16:00:00',
                'start' => '2023-12-10',
                'end' => '2024-04-10',
                'base_elevation' => 330,
            ],

            // Banff
            [
                'name' => 'Banff Sunshine',
                'slug' => 'banff-sunshine',
                'town_id' => $towns['banff']->id,
                'latitude' => 51.0770,
                'longitude' => -115.7630,
                'image_url' => 'http://example.com/banff.jpg',
                'open' => '08:30:00',
                'close' => '16:00:00',
                'start' => '2023-11-10',
                'end' => '2024-05-20',
                'base_elevation' => 1383,
            ],

            // Vail
            [
                'name' => 'Vail',
                'slug' => 'vail',
                'town_id' => $towns['vail']->id,
                'latitude' => 39.6061,
                'longitude' => -106.3550,
                'image_url' => 'http://example.com/vail.jpg',
                'open' => '08:30:00',
                'close' => '16:00:00',
                'start' => '2023-11-17',
                'end' => '2024-04-21',
                'base_elevation' => 2445,
            ],

            // Breckenridge
            [
                'name' => 'Breckenridge',
                'slug' => 'breckenridge',
                'town_id' => $towns['breckenridge']->id,
                'latitude' => 39.4807,
                'longitude' => -106.0667,
                'image_url' => 'http://example.com/breck.jpg',
                'open' => '08:30:00',
                'close' => '16:00:00',
                'start' => '2023-11-10',
                'end' => '2024-05-27',
                'base_elevation' => 2926,
            ],
        ];

        foreach ($resorts as $resort) {
            Resort::firstOrCreate(
                ['slug' => $resort['slug']],
                $resort
            );
        }
    }
}
