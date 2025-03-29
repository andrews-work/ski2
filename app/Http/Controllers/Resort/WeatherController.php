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

    public function getWeather($resortName)
    {
        try {
            $resort = Resort::where('name', $resortName)->firstOrFail();
            $currentData = $this->getCurrent($resort);

            // Log successful weather data retrieval
            Log::info($this->formatLogMessage("Weather data retrieved", [
                'Resort' => $resort->name,
                'Sunrise' => $currentData['sunrise'] ?? null,
                'Sunset' => $currentData['sunset'] ?? null,
                'Timezone' => $resort->timezone ?? 'UTC',
                'Server Time' => now()->format($this->logDateFormat),
                'Resort Time' => $resort->timezone
                    ? now()->setTimezone($resort->timezone)->format($this->logDateFormat)
                    : null
            ]));

            $responseData = [
                'status' => 'success',
                'data' => $currentData,
                'resort' => $resort->name,
                'timezone' => $resort->timezone ?? 'UTC'
            ];

            Log::debug($this->formatLogMessage("Frontend Payload", [
                'Status' => $responseData['status'],
                'Resort' => $responseData['resort'],
                'Timezone' => $responseData['timezone'],
                'Server Time' => now()->format($this->logDateFormat),
                'Resort Time' => $resort->timezone
                    ? now()->setTimezone($resort->timezone)->format($this->logDateFormat)
                    : 'N/A',
                'Weather Data' => $responseData['data']
            ]));

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

    protected function getCurrent(Resort $resort)
    {
        try {
            $apiResponse = $this->getOpenWeatherData($resort);
            $currentWeather = $apiResponse['current'] ?? [];
            $dailyForecast = $apiResponse['daily'][0] ?? [];

            Log::debug($this->formatLogMessage("Snow Analysis", [
                'Resort' => $resort->name,
                'Current Snow' => $currentWeather['snow']['1h'] ?? '0 mm',
                'Daily Snow' => $dailyForecast['snow'] ?? '0 mm',
                'Precipitation' => isset($dailyForecast['rain'])
                    ? $dailyForecast['rain'] . ' mm rain'
                    : (isset($dailyForecast['snow']) ? $dailyForecast['snow'] . ' mm snow' : 'none'),
                'Time' => now()->format($this->logDateFormat)
            ]));

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
                'wind_speed' => $currentWeather['wind_speed'] ?? null,
                'uvi' => $currentWeather['uvi'] ?? null,
                'visibility' => $currentWeather['visibility'] ?? null,
                'daily_snow' => $dailyForecast['snow'] ?? null,
                'snow_1h' => $currentWeather['snow']['1h'] ?? null,
                'weather_condition' => $currentWeather['weather'][0]['main'] ?? null,
                'weather_description' => $currentWeather['weather'][0]['description'] ?? null
            ];

        } catch (\Exception $e) {
            Log::error($this->formatLogMessage("Weather Processing Error", [
                'Resort' => $resort->name,
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
