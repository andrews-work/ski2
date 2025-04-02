<?php

namespace App\Http\Controllers\Resort;

use App\Http\Controllers\Controller;
use App\Models\Resort;
use App\Services\InfoService;
use App\Services\WeatherService;
use Carbon\Carbon;
use Exception;
use Illuminate\Support\Facades\Log;

class InfoController extends Controller
{
    protected $infoService;
    protected $weatherService;

    public function __construct(InfoService $infoService, WeatherService $weatherService)
    {
        $this->infoService = $infoService;
        $this->weatherService = $weatherService;
    }

    public function getResortData($resortName)
    {
        try {
            $resort = Resort::where('name', $resortName)->firstOrFail();

            $localTimeData = $this->infoService->getLocalTime($resort);
            $coordinates = $this->infoService->getLatLong($resort);
            $timezone = $this->infoService->getTimezone($resort);
            $resort->timezone = $timezone;
            $resort->latitude = $coordinates['latitude'] ?? null;
            $resort->longitude = $coordinates['longitude'] ?? null;

            // Get weather data
            $weatherData = $this->weatherService->getWeatherData($resort);

            return [
                'status' => 'success',
                'resort' => $resort,
                'local_time' => $localTimeData['local_time'] ?? null,
                'lift_data' => $this->infoService->getLiftyData($resort),
                'state_info' => $this->infoService->getStateInfo($resort),
                'elevation' => $this->infoService->getElevation($resort),
                'weatherData' => [ 
                    'data' => [
                        'current' => $weatherData['current'] ?? null,
                        'hourly' => $weatherData['hourly'] ?? null,
                        'snow' => $weatherData['snow'] ?? null
                    ]
                ],
                'message' => 'Resort data updated successfully'
            ];
        } catch (Exception $e) {
            Log::error("Failed to get resort data", [
                'resort' => $resortName,
                'error' => $e->getMessage(),
                'trace' => $e->getTraceAsString()
            ]);

            return [
                'status' => 'error',
                'message' => 'Failed to fetch resort data',
                'error' => $e->getMessage()
            ];
        }
    }
}
