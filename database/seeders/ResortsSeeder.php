<?php

namespace Database\Seeders;

use App\Models\Country;
use App\Models\Resort;
use Illuminate\Database\Seeder;

class ResortsSeeder extends Seeder
{
    public function run(): void
    {
        // Fetch countries by their slugs
        $countries = [
            'france' => Country::where('slug', 'france')->first(),
            'switzerland' => Country::where('slug', 'switzerland')->first(),
            'canada' => Country::where('slug', 'canada')->first(),
            'united-states' => Country::where('slug', 'united-states')->first(),
            'japan' => Country::where('slug', 'japan')->first(),
            'australia' => Country::where('slug', 'australia')->first(),
            'new-zealand' => Country::where('slug', 'new-zealand')->first(),
            'argentina' => Country::where('slug', 'argentina')->first(),
            'chile' => Country::where('slug', 'chile')->first(),
        ];

        // Define resorts for each country
        $resorts = [
            // France
            [
                'name' => 'Chamonix',
                'slug' => 'chamonix',
                'country_id' => $countries['france']->id,
                'season_start' => '2023-12-01',
                'season_end' => '2024-04-15',
                'image_url' => 'https://www.intersportrent.com/IIC/FR/Argentière/image-thumb__26502__ir-2021-img-text/©OT_Chamonix-Mont-Blanc-SA%20_Argentière(1).JPG@2x.jpeg',
                'wiki_url' => 'Chamonix',
            ],
            [
                'name' => 'Val Thorens',
                'slug' => 'val-thorens',
                'country_id' => $countries['france']->id,
                'season_start' => '2023-11-25',
                'season_end' => '2024-05-05',
                'image_url' => 'https://evasion-online.com/image-photo/ski+a+val+thorens/Shooting%20ski%20-%20T.Loubere%20OT%20Val%20Thorens%20-%204.jpg',
                'wiki_url' => 'Val_Thorens',
            ],

            // Switzerland
            [
                'name' => 'Zermatt',
                'slug' => 'zermatt',
                'country_id' => $countries['switzerland']->id,
                'season_start' => '2023-11-18',
                'season_end' => '2024-04-21',
                'image_url' => 'https://static.vecteezy.com/system/resources/thumbnails/008/603/847/original/beautiful-footage-of-the-famous-zermatt-ski-resort-with-the-iconic-matterhorn-peak-in-the-alps-in-winter-in-switzerland-people-enjoying-magical-ski-resort-video.jpg',
                'wiki_url' => 'Zermatt',
            ],
            [
                'name' => 'St. Moritz',
                'slug' => 'st-moritz',
                'country_id' => $countries['switzerland']->id,
                'season_start' => '2023-12-02',
                'season_end' => '2024-04-14',
                'image_url' => 'https://assets.vogue.com/photos/58b09cb73538311fcc60159f/master/w_1280%2Cc_limit/00-holding-winter-guide-to-st-moritz-switzerland.jpg',
                'wiki_url' => 'St._Moritz',
            ],

            // Canada
            [
                'name' => 'Whistler Blackcomb',
                'slug' => 'whistler-blackcomb',
                'country_id' => $countries['canada']->id,
                'season_start' => '2023-11-23',
                'season_end' => '2024-05-20',
                'image_url' => 'http://agnarchy.com/wp-content/uploads/2016/08/Winter-Dual-Mountain-Village-Evening-Bluebird-Lights-DavidMcColm-26390.jpg',
                'wiki_url' => 'whistler_blackcomb',
            ],

            // United States
            [
                'name' => 'Vail',
                'slug' => 'vail',
                'country_id' => $countries['united-states']->id,
                'season_start' => '2023-11-10',
                'season_end' => '2024-04-21',
                'image_url' => 'https://www.govail.com/hs-fs/hubfs/20151202_132726_HDR_1.jpg?width=5262&name=20151202_132726_HDR_1.jpg',
                'wiki_url' => 'Vail_Ski_Resort',
            ],

            // Japan
            [
                'name' => 'Niseko',
                'slug' => 'niseko',
                'country_id' => $countries['japan']->id,
                'season_start' => '2023-12-01',
                'season_end' => '2024-03-31',
                'image_url' => 'https://www.qantas.com.au/content/travelinsider/en/explore/asia/japan/ski-japan-resorts-holidays-season-when-best-time-where-to-go/jcr:content/parsysTop/hero.img.full.high.jpg/1566351096326.jpg',
                'wiki_url' => 'Niseko_Mt._Resort_Grand_Hirafu',
            ],

            // Australia
            [
                'name' => 'Thredbo',
                'slug' => 'thredbo',
                'country_id' => $countries['australia']->id,
                'season_start' => '2023-06-10',
                'season_end' => '2023-10-01',
                'image_url' => 'https://www.mountainwatch.com/wp-content/uploads/2018/04/TessBoller_Thredbo-6.jpg',
                'wiki_url' => 'Thredbo,_New_South_Wales',
            ],

            // New Zealand
            [
                'name' => 'Queenstown',
                'slug' => 'queenstown',
                'country_id' => $countries['new-zealand']->id,
                'season_start' => '2023-06-01',
                'season_end' => '2023-10-15',
                'image_url' => 'https://new.foxyms.co.nz/files/eq/resources/Cardrona-ski-field.jpg',
                'wiki_url' => 'Cardrona_Alpine_Resort',
            ],

            // Argentina
            [
                'name' => 'Cerro Catedral',
                'slug' => 'cerro-catedral',
                'country_id' => $countries['argentina']->id,
                'season_start' => '2023-06-15',
                'season_end' => '2023-10-15',
                'image_url' => 'https://snowbrains.com/wp-content/uploads/2022/09/DSC08841.jpg',
                'wiki_url' => 'Cerro_Catedral',
            ],

            // Chile
            [
                'name' => 'Valle Nevado',
                'slug' => 'valle-nevado',
                'country_id' => $countries['chile']->id,
                'season_start' => '2023-06-15',
                'season_end' => '2023-10-15',
                'image_url' => 'https://vulcanopro.s3.amazonaws.com/images/lar_X70lVnhiKycp1nBv8nbuPmkhzvDh2Vqw4jXJCvEh.jpeg',
                'wiki_url' => 'Valle_Nevado',
            ],
        ];

        // Insert resorts into the database
        foreach ($resorts as $resort) {
            Resort::create($resort);
        }
    }
}
