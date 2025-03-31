<?php

namespace App\Http\Controllers\Resort;

use App\Http\Controllers\Controller;
use App\Models\Resort;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;
use Carbon\Carbon;

class WeatherController extends Controller
{
    protected $logDateFormat = 'Y-m-d H:i:s';
    protected $activeApi = 'open_weather';

    public function getWeather($resortName)
    {
        try {
            $resort = Resort::where('name', $resortName)->firstOrFail();

            // Get data from both APIs
            $openWeatherData = $this->getOpenWeatherData($resort);
            $weatherUnlockedData = $this->getWeatherUnlockedData($resort);

            // Log both responses for comparison
            Log::debug($this->formatLogMessage("API Comparison", [
                'Resort' => $resort->name,
                'OpenWeather Status' => $openWeatherData['status'] ?? null,
                'WeatherUnlocked Status' => $weatherUnlockedData['status'] ?? null,
                'Time' => now()->format($this->logDateFormat)
            ]));

            // Process data from default API (OpenWeather)
            $currentData = $this->getCurrent($resort, $openWeatherData);
            $hourlyData = $this->getHourly($resort, $openWeatherData);

            // Log successful weather data retrieval
            Log::info($this->formatLogMessage("Weather data retrieved", [
                'Resort' => $resort->name,
                'API' => $this->activeApi,
                'Sunrise' => $currentData['sunrise'] ?? null,
                'Sunset' => $currentData['sunset'] ?? null,
                'Hourly_Data_Points' => count($hourlyData),
                'Timezone' => $resort->timezone ?? 'UTC',
                'Server Time' => now()->format($this->logDateFormat),
                'Resort Time' => $resort->timezone
                    ? now()->setTimezone($resort->timezone)->format($this->logDateFormat)
                    : null,
                'WeatherUnlocked_Data' => $weatherUnlockedData // Log for comparison
            ]));

            $responseData = [
                'status' => 'success',
                'data' => array_merge($currentData, ['hourly' => $hourlyData]),
                'resort' => $resort->name,
                'timezone' => $resort->timezone ?? 'UTC',
                'weather_unlocked_data' => $weatherUnlockedData // Include for debugging
            ];

            return $responseData;

        } catch (\Exception $e) {
            Log::error($this->formatLogMessage("Weather Data Error", [
                'Resort' => $resortName ?? 'unknown',
                'Time' => now()->format($this->logDateFormat),
                'Error' => $e->getMessage(),
                'Trace' => $e->getTraceAsString()
            ]));

            return [
                'status' => 'error',
                'message' => 'Weather data unavailable',
                'error' => $e->getMessage()
            ];
        }
    }

    protected function getHourly(Resort $resort, array $apiResponse)
    {
        try {
            $hourlyForecast = $apiResponse['hourly'] ?? [];
            $timezone = $apiResponse['timezone'] ?? $resort->timezone ?? 'UTC';

            // Process hourly data for next 24 hours
            $next24Hours = array_slice($hourlyForecast, 0, 24);
            $processedHourly = array_map(function($hour) use ($timezone) {
                return [
                    'dt' => $hour['dt'],
                    'time' => Carbon::createFromTimestamp($hour['dt'], 'UTC')
                        ->setTimezone($timezone)
                        ->format('H:i'),
                    'temp' => round($hour['temp']),
                    'feels_like' => round($hour['feels_like']),
                    'wind_speed' => round($hour['wind_speed'] * 3.6), // Convert to km/h
                    'visibility' => round($hour['visibility'] / 1000, 1), // Convert to km
                    'icon' => $hour['weather'][0]['icon'] ?? null,
                    'weather_description' => $hour['weather'][0]['description'] ?? null
                ];
            }, $next24Hours);

            Log::debug($this->formatLogMessage("Processed Hourly Data", [
                'Resort' => $resort->name,
                'Data_Points' => count($processedHourly),
                'First_Hour' => $processedHourly[0]['time'] ?? null,
                'Last_Hour' => end($processedHourly)['time'] ?? null,
                'Time' => now()->format($this->logDateFormat)
            ]));

            return $processedHourly;

        } catch (\Exception $e) {
            Log::error($this->formatLogMessage("Hourly Data Processing Error", [
                'Resort' => $resort->name,
                'Error' => $e->getMessage(),
                'Trace' => $e->getTraceAsString(),
                'Time' => now()->format($this->logDateFormat)
            ]));
            return [];
        }
    }

    protected function getCurrent(Resort $resort, array $apiResponse)
    {
        try {
            $currentWeather = $apiResponse['current'] ?? [];
            $dailyForecast = $apiResponse['daily'][0] ?? [];
            $timezone = $apiResponse['timezone'] ?? $resort->timezone ?? 'UTC';
            $sunrise = $currentWeather['sunrise'] ?? null;
            $sunset = $currentWeather['sunset'] ?? null;

            return [
                // Time data
                'sunrise' => $sunrise
                    ? Carbon::createFromTimestamp($sunrise, 'UTC')
                        ->setTimezone($timezone)
                        ->format('Y-m-d H:i:s')
                    : null,
                'sunset' => $sunset
                    ? Carbon::createFromTimestamp($sunset, 'UTC')
                        ->setTimezone($timezone)
                        ->format('Y-m-d H:i:s')
                    : null,
                'timezone' => $timezone,
                'timezone_offset' => $apiResponse['timezone_offset'] ?? 0,
                'current_time' => now()->setTimezone($timezone)->format('Y-m-d H:i:s'),

                // Weather data
                'temp' => $currentWeather['temp'] ?? null,
                'feels_like' => $currentWeather['feels_like'] ?? null,
                'humidity' => $currentWeather['humidity'] ?? null,
                'wind_speed' => $currentWeather['wind_speed'] ? round($currentWeather['wind_speed'] * 3.6) : null, // Convert to km/h
                'uvi' => $currentWeather['uvi'] ?? null,
                'visibility' => $currentWeather['visibility'] ? round($currentWeather['visibility'] / 1000, 1) : null, // Convert to km
                'daily_snow' => $dailyForecast['snow'] ?? null,
                'snow_1h' => $currentWeather['snow']['1h'] ?? null,
                'weather_condition' => $currentWeather['weather'][0]['main'] ?? null,
                'weather_description' => $currentWeather['weather'][0]['description'] ?? null
            ];

        } catch (\Exception $e) {
            Log::error($this->formatLogMessage("Current Weather Processing Error", [
                'Resort' => $resort->name,
                'Error' => $e->getMessage(),
                'Trace' => $e->getTraceAsString(),
                'Time' => now()->format($this->logDateFormat)
            ]));
            throw $e;
        }
    }

    protected function getOpenWeatherData(Resort $resort)
    {
        try {
            $url = $this->getUrl($resort);
            $response = Http::get($url);
            $responseData = $response->json();

            Log::debug($this->formatLogMessage("API Response Structure", [
                'Resort' => $resort->name,
                'Status' => $response->status(),
                'Has Current' => isset($responseData['current']),
                'Has Daily' => isset($responseData['daily']),
                'Current Keys' => isset($responseData['current'])
                    ? array_keys($responseData['current'])
                    : [],
                'Daily Keys' => isset($responseData['daily'][0])
                    ? array_keys($responseData['daily'][0])
                    : [],
                'Time' => now()->format($this->logDateFormat)
            ]));

            $fullResponseLog = sprintf(
                "Full API Response\n%s\n" .
                "URL: %s\n" .
                "Headers:\n%s\n",
                json_encode($responseData, JSON_PRETTY_PRINT),
                $url,
                json_encode($response->headers(), JSON_PRETTY_PRINT)
            );
            Log::debug($fullResponseLog);

            if ($response->failed()) {
                throw new \Exception("API request failed with status: " . $response->status());
            }

            return $responseData;

        } catch (\Exception $e) {
            Log::error($this->formatLogMessage("API Request Failed", [
                'Resort' => $resort->name,
                'URL' => $url ?? 'not constructed',
                'Error' => $e->getMessage(),
                'Trace' => $e->getTraceAsString(),
                'Time' => now()->format($this->logDateFormat)
            ]));
            throw $e;
        }
    }

    protected function getBaseUrl()
    {
        try {
            $baseUrl = config('services.open_weather.base_url');
            if (empty($baseUrl)) {
                throw new \Exception("OpenWeather base URL not configured");
            }

            Log::debug($this->formatLogMessage("API Configuration", [
                'Base URL' => $baseUrl,
                'Time' => now()->format($this->logDateFormat)
            ]));

            return $baseUrl;

        } catch (\Exception $e) {
            Log::error($this->formatLogMessage("Configuration Error", [
                'Error' => $e->getMessage(),
                'Time' => now()->format($this->logDateFormat)
            ]));
            throw $e;
        }
    }

    protected function getUrl(Resort $resort)
    {
        try {
            $baseUrl = $this->getBaseUrl();
            $apiKey = config('services.open_weather.api_key');

            if (empty($resort->latitude) || empty($resort->longitude)) {
                throw new \Exception("Missing coordinates for resort");
            }

            $url = $baseUrl . http_build_query([
                'lat' => $resort->latitude,
                'lon' => $resort->longitude,
                'appid' => $apiKey,
                'units' => 'metric'
            ]);

            Log::debug($this->formatLogMessage("Constructed API URL", [
                'Resort' => $resort->name,
                'URL' => preg_replace('/appid=[^&]+/', 'appid=***', $url),
                'Time' => now()->format($this->logDateFormat)
            ]));

            return $url;

        } catch (\Exception $e) {
            Log::error($this->formatLogMessage("URL Construction Error", [
                'Resort' => $resort->name ?? 'unknown',
                'Error' => $e->getMessage(),
                'Time' => now()->format($this->logDateFormat)
            ]));
            throw $e;
        }
    }

    protected function getWeatherUnlockedData(Resort $resort)
    {
        try {
            $url = $this->getWeatherUnlockedUrl($resort);
            $response = Http::get($url);
            $responseData = $response->json();

            Log::debug($this->formatLogMessage("WeatherUnlocked API Response", [
                'Resort' => $resort->name,
                'Status' => $response->status(),
                'Response_Keys' => array_keys($responseData),
                'Time' => now()->format($this->logDateFormat)
            ]));

            if ($response->failed()) {
                throw new \Exception("WeatherUnlocked API request failed with status: " . $response->status());
            }

            return $responseData;

        } catch (\Exception $e) {
            Log::error($this->formatLogMessage("WeatherUnlocked API Error", [
                'Resort' => $resort->name,
                'Error' => $e->getMessage(),
                'Time' => now()->format($this->logDateFormat)
            ]));
            return ['status' => 'error', 'message' => $e->getMessage()];
        }
    }

    protected function getWeatherUnlockedUrl(Resort $resort)
    {
        try {
            $baseUrl = config('services.weather_unlocked.base_url');
            $appId = config('services.weather_unlocked.app_id');
            $appKey = config('services.weather_unlocked.app_key');
            $resortId = $resort->weather_unlocked_id;

            if (empty($resortId)) {
                throw new \Exception("WeatherUnlocked resort ID not configured for this resort");
            }

            if (empty($appId) || empty($appKey)) {
                throw new \Exception("WeatherUnlocked API credentials not configured");
            }

            $url = sprintf(
                '%s%s?app_id=%s&app_key=%s',
                $baseUrl,
                $resortId,
                urlencode($appId),
                urlencode($appKey)
            );

            // Secure logging that hides credentials
            Log::debug($this->formatLogMessage("Constructed WeatherUnlocked URL", [
                'Resort' => $resort->name,
                'Base_URL' => $baseUrl,
                'Resort_ID' => $resortId,
                'Has_App_ID' => !empty($appId),
                'Has_App_Key' => !empty($appKey),
                'Time' => now()->format($this->logDateFormat)
            ]));

            return $url;

        } catch (\Exception $e) {
            Log::error($this->formatLogMessage("WeatherUnlocked URL Construction Error", [
                'Resort' => $resort->name ?? 'unknown',
                'Error' => $e->getMessage(),
                'Time' => now()->format($this->logDateFormat)
            ]));
            throw $e;
        }
    }

    private function formatLogMessage(string $title, array $data): string
    {
        $lines = ["{$title}\n" . str_repeat('-', strlen($title))];

        foreach ($data as $key => $value) {
            if (is_array($value)) {
                $lines[] = "{$key}:\n" . json_encode($value, JSON_PRETTY_PRINT);
            } else {
                $lines[] = sprintf("%-20s: %s", $key, $value);
            }
        }

        return implode("\n", $lines) . "\n";
    }
}
