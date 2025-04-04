<?php

namespace Database\Seeders;

use App\Models\Country;
use App\Models\Continent;
use Illuminate\Database\Seeder;

class CountriesTableSeeder extends Seeder
{
    public function run(): void
    {
        $africa = Continent::where('slug', 'africa')->first();
        $asia = Continent::where('slug', 'asia')->first();
        $europe = Continent::where('slug', 'europe')->first();
        $northAmerica = Continent::where('slug', 'north-america')->first();
        $southAmerica = Continent::where('slug', 'south-america')->first();
        $oceania = Continent::where('slug', 'anz')->first();
        $middleEast = Continent::where('slug', 'middle-east')->first();

        $countries = [
            // Africa
            ['name' => 'Morocco', 'slug' => 'morocco', 'continent_id' => $africa->id],
            ['name' => 'South Africa', 'slug' => 'south-africa', 'continent_id' => $africa->id],

            // Asia
            ['name' => 'Afghanistan', 'slug' => 'afghanistan', 'continent_id' => $asia->id],
            ['name' => 'Bhutan', 'slug' => 'bhutan', 'continent_id' => $asia->id],
            ['name' => 'China', 'slug' => 'china', 'continent_id' => $asia->id],
            ['name' => 'India', 'slug' => 'india', 'continent_id' => $asia->id],
            ['name' => 'Japan', 'slug' => 'japan', 'continent_id' => $asia->id],
            ['name' => 'Kazakhstan', 'slug' => 'kazakhstan', 'continent_id' => $asia->id],
            ['name' => 'Kyrgyzstan', 'slug' => 'kyrgyzstan', 'continent_id' => $asia->id],
            ['name' => 'Mongolia', 'slug' => 'mongolia', 'continent_id' => $asia->id],
            ['name' => 'Nepal', 'slug' => 'nepal', 'continent_id' => $asia->id],
            ['name' => 'Pakistan', 'slug' => 'pakistan', 'continent_id' => $asia->id],
            ['name' => 'Russia', 'slug' => 'russia', 'continent_id' => $asia->id],
            ['name' => 'South Korea', 'slug' => 'south-korea', 'continent_id' => $asia->id],
            ['name' => 'Tajikistan', 'slug' => 'tajikistan', 'continent_id' => $asia->id],
            ['name' => 'Turkmenistan', 'slug' => 'turkmenistan', 'continent_id' => $asia->id],
            ['name' => 'Uzbekistan', 'slug' => 'uzbekistan', 'continent_id' => $asia->id],

            // // Europe
            ['name' => 'Albania', 'slug' => 'albania', 'continent_id' => $europe->id],
            ['name' => 'Andorra', 'slug' => 'andorra', 'continent_id' => $europe->id],
            ['name' => 'Austria', 'slug' => 'austria', 'continent_id' => $europe->id],
            ['name' => 'Belgium', 'slug' => 'belgium', 'continent_id' => $europe->id],
            ['name' => 'Bosnia and Herzegovina', 'slug' => 'bosnia-and-herzegovina', 'continent_id' => $europe->id],
            ['name' => 'Bulgaria', 'slug' => 'bulgaria', 'continent_id' => $europe->id],
            ['name' => 'Croatia', 'slug' => 'croatia', 'continent_id' => $europe->id],
            ['name' => 'Czech Republic', 'slug' => 'czech-republic', 'continent_id' => $europe->id],
            ['name' => 'Estonia', 'slug' => 'estonia', 'continent_id' => $europe->id],
            ['name' => 'Finland', 'slug' => 'finland', 'continent_id' => $europe->id],
            ['name' => 'France', 'slug' => 'france', 'continent_id' => $europe->id],
            ['name' => 'Germany', 'slug' => 'germany', 'continent_id' => $europe->id],
            ['name' => 'Italy', 'slug' => 'italy', 'continent_id' => $europe->id],
            ['name' => 'Kosovo', 'slug' => 'kosovo', 'continent_id' => $europe->id],
            ['name' => 'Liechtenstein', 'slug' => 'liechtenstein', 'continent_id' => $europe->id],
            ['name' => 'Luxembourg', 'slug' => 'luxembourg', 'continent_id' => $europe->id],
            ['name' => 'Montenegro', 'slug' => 'montenegro', 'continent_id' => $europe->id],
            ['name' => 'Netherlands', 'slug' => 'netherlands', 'continent_id' => $europe->id],
            ['name' => 'North Macedonia', 'slug' => 'north-macedonia', 'continent_id' => $europe->id],
            ['name' => 'Poland', 'slug' => 'poland', 'continent_id' => $europe->id],
            ['name' => 'Romania', 'slug' => 'romania', 'continent_id' => $europe->id],
            ['name' => 'Serbia', 'slug' => 'serbia', 'continent_id' => $europe->id],
            ['name' => 'Slovakia', 'slug' => 'slovakia', 'continent_id' => $europe->id],
            ['name' => 'Slovenia', 'slug' => 'slovenia', 'continent_id' => $europe->id],
            ['name' => 'Spain', 'slug' => 'spain', 'continent_id' => $europe->id],
            ['name' => 'Sweden', 'slug' => 'sweden', 'continent_id' => $europe->id],
            ['name' => 'Switzerland', 'slug' => 'switzerland', 'continent_id' => $europe->id],
            ['name' => 'Ukraine', 'slug' => 'ukraine', 'continent_id' => $europe->id],

            // North America
            ['name' => 'Canada', 'slug' => 'canada', 'continent_id' => $northAmerica->id],
            ['name' => 'United States', 'slug' => 'united-states', 'continent_id' => $northAmerica->id],

            // Oceania
            ['name' => 'Australia', 'slug' => 'australia', 'continent_id' => $oceania->id],
            ['name' => 'New Zealand', 'slug' => 'new-zealand', 'continent_id' => $oceania->id],

            // South America
            ['name' => 'Argentina', 'slug' => 'argentina', 'continent_id' => $southAmerica->id],
            ['name' => 'Chile', 'slug' => 'chile', 'continent_id' => $southAmerica->id],
            ['name' => 'Bolivia', 'slug' => 'bolivia', 'continent_id' => $southAmerica->id],
            ['name' => 'Peru', 'slug' => 'peru', 'continent_id' => $southAmerica->id],
            ['name' => 'Ecuador', 'slug' => 'ecuador', 'continent_id' => $southAmerica->id],

            // // Middle East
            ['name' => 'Armenia', 'slug' => 'armenia', 'continent_id' => $middleEast->id],
            ['name' => 'Georgia', 'slug' => 'georgia', 'continent_id' => $middleEast->id],
            ['name' => 'Iran', 'slug' => 'iran', 'continent_id' => $middleEast->id],
            ['name' => 'Israel', 'slug' => 'israel', 'continent_id' => $middleEast->id],
            ['name' => 'Lebanon', 'slug' => 'lebanon', 'continent_id' => $middleEast->id],
            ['name' => 'Turkey', 'slug' => 'turkey', 'continent_id' => $middleEast->id],

        ];

        foreach ($countries as $country) {
            Country::create($country);
        }
    }
}
