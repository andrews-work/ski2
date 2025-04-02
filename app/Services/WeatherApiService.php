<?php

namespace App\Services;

use App\Models\Resort;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class WeatherApiService
{
    public function getOpenWeatherData(Resort $resort): array
    {
        try {
            $url = $this->getOpenWeatherUrl($resort);
            $response = Http::get($url);

            if ($response->failed()) {
                throw new \Exception("API request failed with status: " . $response->status());
            }

            return $response->json();
        } catch (\Exception $e) {
            Log::error("OpenWeather API Error: " . $e->getMessage());
            throw $e;
        }
    }

    protected function getOpenWeatherUrl(Resort $resort): string
    {
        $baseUrl = config('services.open_weather.base_url');
        $apiKey = config('services.open_weather.api_key');

        if (empty($resort->latitude) || empty($resort->longitude)) {
            throw new \Exception("Missing coordinates for resort");
        }

        return $baseUrl . http_build_query([
            'lat' => $resort->latitude,
            'lon' => $resort->longitude,
            'appid' => $apiKey,
            'units' => 'metric'
        ]);
    }

    public function getWeatherUnlockedData(Resort $resort): array
    {
        try {
            if (empty($resort->weather_unlocked_id)) {
                throw new \Exception('WeatherUnlocked not configured for this resort');
            }

            if (empty(config('services.weather_unlocked.app_id'))) {
                throw new \Exception('WeatherUnlocked API not configured');
            }

            $url = $this->getWeatherUnlockedUrl($resort);
            $response = Http::get($url);

            if ($response->failed()) {
                throw new \Exception("API request failed with status: " . $response->status());
            }

            return $response->json();
        } catch (\Exception $e) {
            Log::error("WeatherUnlocked API Error: " . $e->getMessage());
            throw $e;
        }
    }

    protected function getWeatherUnlockedUrl(Resort $resort): string
    {
        $baseUrl = config('services.weather_unlocked.base_url');
        $appId = config('services.weather_unlocked.app_id');
        $appKey = config('services.weather_unlocked.app_key');
        $resortId = $resort->weather_unlocked_id;

        if (empty($resortId)) {
            throw new \Exception("WeatherUnlocked resort ID not configured");
        }

        return sprintf(
            '%s%s?app_id=%s&app_key=%s',
            $baseUrl,
            $resortId,
            urlencode($appId),
            urlencode($appKey)
        );
    }

}
