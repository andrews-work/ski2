<?php

namespace App\Http\Controllers\Resort;

use App\Http\Controllers\Controller;
use App\Models\Resort;
use App\Services\WeatherService;

class WeatherController extends Controller
{
    protected $weatherService;

    public function __construct(WeatherService $weatherService)
    {
        $this->weatherService = $weatherService;
    }

    public function getWeather($resortName)
    {
        try {
            $resort = Resort::where('name', $resortName)->firstOrFail();

            return [
                'status' => 'success',
                'data' => $this->weatherService->getWeatherData($resort),
                'resort' => $resort->name,
                'timezone' => $resort->timezone ?? 'UTC'
            ];

        } catch (\Exception $e) {
            return [
                'status' => 'error',
                'message' => 'Weather data unavailable',
                'error' => $e->getMessage()
            ];
        }
    }
}
