<?php

namespace App\Services;

use App\Models\Resort;
use Exception;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class InfoApiService
{
    public function fetchGeoData(string $resortName): array
    {
        try {
            $baseUrl = config('services.geo_api.base_url');
            if (empty($baseUrl)) {
                throw new \Exception('Geo API base URL not configured');
            }

            $response = Http::timeout(10)
                ->retry(3, 500)
                ->get($baseUrl, [
                    'text' => $resortName,
                    'format' => 'json',
                    'apiKey' => config('services.geo_api.api_key')
                ]);

            if ($response->failed()) {
                Log::warning("Geo API request failed", [
                    'status' => $response->status(),
                    'response' => $response->body(),
                    'url' => $baseUrl
                ]);
                return ['results' => []];
            }

            $data = $response->json();

            if (empty($data['results'])) {
                Log::warning("Geo API returned empty results", [
                    'resort' => $resortName,
                    'response' => $data
                ]);
            }

            return $data;

        } catch (\Exception $e) {
            Log::error("Geo API connection failed", [
                'resort' => $resortName,
                'error' => $e->getMessage(),
                'trace' => $e->getTraceAsString()
            ]);
            return ['results' => []];
        }
    }

    public function fetchElevation(float $lat, float $lon): ?float
    {
        try {
            $baseUrl = config('services.open_meteo.base_url');

            if (empty($baseUrl)) {
                throw new Exception('base url incorrect for elevation api');
            }

            $queryParams = [
                'latitude' => $lat,
                'longitude' => $lon,
            ];

            $fullUrl = $baseUrl . '?' . http_build_query($queryParams);
            Log::debug('Elevation API request URL', ['url' => $fullUrl]);

            $response = Http::get($baseUrl, $queryParams);

            if ($response->failed()) {
                Log::warning("Elevation API request failed", [
                    'status' => $response->status(),
                    'response' => $response->body(),
                    'url' => $fullUrl
                ]);
                return null;
            }

            return $response->json()['elevation'][0] ?? null;

        } catch (\Exception $e) {
            Log::error("Elevation API failure", [
                'latitude' => $lat,
                'longitude' => $lon,
                'error' => $e->getMessage(),
                'url' => $fullUrl ?? 'URL not constructed'
            ]);
            return null;
        }
    }

    public function fetchLiftyData(Resort $resort): array
    {
        try {
            $baseUrl = config('services.lifty.base_url');
            if (empty($baseUrl)) {
                throw new \Exception('Lifty API base URL not configured');
            }

            if (empty($resort->slug)) {
                throw new \Exception('Resort slug is empty');
            }

            $url = $baseUrl . '/' . $resort->slug;

            // Log::debug("Lifty API Request", [ 'url' => $url ]);

            $response = Http::timeout(10)
                ->retry(3, 500)
                ->get($url);

            if ($response->failed()) {
                throw new \Exception("API request failed with status: " . $response->status());
            }

            return $response->json() ?? [];

        } catch (\Exception $e) {
            Log::error("Lifty API Failure", [
                'resort' => $resort->name,
                'error' => $e->getMessage(),
                'url' => $url ?? 'Not constructed',
                'trace' => $e->getTraceAsString()
            ]);
            throw $e;
        }
    }
}
