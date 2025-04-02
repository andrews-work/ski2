<?php

namespace App\Services;

use App\Models\Resort;
use Carbon\Carbon;
use Exception;

class WeatherService
{
    protected $weatherApiService;

    public function __construct(WeatherApiService $weatherApiService)
    {
        $this->weatherApiService = $weatherApiService;
    }

    public function getWeatherData(Resort $resort): array
    {
        try {
            $openWeatherData = $this->weatherApiService->getOpenWeatherData($resort);
            $weatherUnlockedData = $this->getWeatherUnlockedResponse($resort);

            return [
                'current' => $this->processOpenWeatherCurrent($resort, $openWeatherData),
                'hourly' => $this->processOpenWeatherHourly($resort, $openWeatherData),
                'snow' => $this->processWeatherUnlockedData($weatherUnlockedData)
            ];
        } catch (Exception $e) {
            throw $e;
        }
    }

    protected function getWeatherUnlockedResponse(Resort $resort): array
    {
        try {
            return $this->weatherApiService->getWeatherUnlockedData($resort);
        } catch (Exception $e) {
            return [
                'status' => 'error',
                'message' => $e->getMessage()
            ];
        }
    }

    protected function processOpenWeatherCurrent(Resort $resort, array $apiResponse): array
    {
        $currentWeather = $apiResponse['current'] ?? [];
        $dailyForecast = $apiResponse['daily'][0] ?? [];
        $timezone = $apiResponse['timezone'] ?? $resort->timezone ?? 'UTC';

        return [
            'temp' => $currentWeather['temp'] ?? null,
            'feels_like' => $currentWeather['feels_like'] ?? null,
            'humidity' => $currentWeather['humidity'] ?? null,
            'wind_speed' => $currentWeather['wind_speed'] ? round($currentWeather['wind_speed'] * 3.6) : null,
            'uvi' => $currentWeather['uvi'] ?? null,
            'visibility' => $currentWeather['visibility'] ? round($currentWeather['visibility'] / 1000, 1) : null,
            'daily_snow' => $dailyForecast['snow'] ?? null,
            'weather_condition' => $currentWeather['weather'][0]['main'] ?? null,
            'weather_description' => $currentWeather['weather'][0]['description'] ?? null
        ];
    }

    protected function processOpenWeatherHourly(Resort $resort, array $apiResponse): array
    {
        $hourlyForecast = $apiResponse['hourly'] ?? [];
        $timezone = $apiResponse['timezone'] ?? $resort->timezone ?? 'UTC';

        return array_map(function($hour) use ($timezone) {
            return [
                'time' => Carbon::createFromTimestamp($hour['dt'], 'UTC')
                    ->setTimezone($timezone)
                    ->format('H:i'),
                'temp' => round($hour['temp']),
                'feels_like' => round($hour['feels_like']),
                'wind_speed' => round($hour['wind_speed'] * 3.6),
                'icon' => $hour['weather'][0]['icon'] ?? null,
                'weather_description' => $hour['weather'][0]['description'] ?? null
            ];
        }, array_slice($hourlyForecast, 0, 24));
    }

    protected function processWeatherUnlockedData(array $apiResponse): array
    {
        if (isset($apiResponse['status']) && $apiResponse['status'] !== 'success') {
            return $apiResponse;
        }

        return [
            'snow_depth' => $apiResponse['snowdepth_cm'] ?? null,
            'snow_quality' => $apiResponse['snow_quality'] ?? null,
            'status' => 'success'
        ];
    }
}
