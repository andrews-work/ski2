<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Third Party Services
    |--------------------------------------------------------------------------
    |
    | This file is for storing the credentials for third party services such
    | as Mailgun, Postmark, AWS and more. This file provides the de facto
    | location for this type of information, allowing packages to have
    | a conventional file to locate the various service credentials.
    |
    */

    'postmark' => [
        'token' => env('POSTMARK_TOKEN'),
    ],

    'ses' => [
        'key' => env('AWS_ACCESS_KEY_ID'),
        'secret' => env('AWS_SECRET_ACCESS_KEY'),
        'region' => env('AWS_DEFAULT_REGION', 'us-east-1'),
    ],

    'resend' => [
        'key' => env('RESEND_KEY'),
    ],

    'slack' => [
        'notifications' => [
            'bot_user_oauth_token' => env('SLACK_BOT_USER_OAUTH_TOKEN'),
            'channel' => env('SLACK_BOT_USER_DEFAULT_CHANNEL'),
        ],
    ],

    // hotels
    'makcorps' => [
        'api_key' => env('MAKCORPS_API_KEY'),
    ],

    // restaurants
    'yelp' => [
        'api_key' => env('YELP_API_KEY'),
        'base_url' => 'https://api.yelp.com/v3/',
    ],

    // lat / long
    'geo_api' => [
        'api_key' => env('GEO_API_KEY'),
        'base_url' => 'https://api.geoapify.com/v1/geocode/search?text='
    ],

    // elevation
    'open_meteo' => [
        'base_url' => 'https://api.open-meteo.com/v1/',
    ],

    // lifty
    'lifty' => [
        'base_url' => 'https://liftie.info/api/resort/',
    ],

    // weather 1
    'open_weather' => [
        'api_key' => env('OPEN_WEATHER_KEY'),
        'base_url' => 'https://api.openweathermap.org/data/3.0/onecall?',
    ],

    // weather unlocked - ski resort weather
    'weather_unlocked' => [
        'api_key' => env('WEATHER_UNLOCKED_KEY'),
        'app_id' => env('WEATHER_UNLOCKED_APP_ID'),
        'base_url' => 'https://api.weatherunlocked.com/api/resortforecast/',
    ],
];
