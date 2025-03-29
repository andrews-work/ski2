<?php

namespace App\Http\Controllers\Resort;

use App\Http\Controllers\Controller;
use App\Models\Resort;
use Exception;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class InfoController extends Controller
{
    public function getResortData($resortName)
    {
        try {
            $resort = Resort::where('name', $resortName)->firstOrFail();
            Log::info("Fetching data for resort", ['resort' => $resortName]);

            if (!$this->hasCoordinates($resort)) {
                $coordinates = $this->getLatLong($resortName);
                $this->saveLatLong($resort, $coordinates);
            }

            return [
                'status' => 'success',
                'resort' => $resort->fresh(),
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

    private function apiCall($resortName): array
    {
        try {
            $apiKey = config('services.geo_api.api_key');
            $baseUrl = config('services.geo_api.base_url');
            $url = $baseUrl . urlencode($resortName) . '&format=json&apiKey=' . $apiKey;

            Log::debug("Making API request", [
                'url' => preg_replace('/apiKey=[^&]+/', 'apiKey=***', $url)
            ]);

            $response = Http::timeout(10)->get($url);

            if (!$response->successful()) {
                throw new \Exception("API request failed with status: " . $response->status());
            }

            return $response->json();

        } catch (Exception $e) {
            Log::error("API call failed", [
                'resort' => $resortName,
                'error' => $e->getMessage()
            ]);
            throw $e;
        }
    }

    private function hasCoordinates(Resort $resort): bool
    {
        return !empty($resort->latitude) && !empty($resort->longitude);
    }

    private function getLatLong($resortName): array
    {
        try {
            $response = $this->apiCall($resortName);

            if (empty($response['results'])) {
                throw new Exception("No results returned from API");
            }

            // Use first result by default
            $result = $response['results'][0];

            return [
                'latitude' => $result['lat'],
                'longitude' => $result['lon'],
                'timezone' => $result['timezone']['name'] ?? null,
                'country' => $result['country'] ?? null
            ];

        } catch (Exception $e) {
            Log::error("Failed to get coordinates", [
                'resort' => $resortName,
                'error' => $e->getMessage()
            ]);
            throw $e;
        }
    }

    private function saveLatLong(Resort $resort, array $coordinates): void
    {
        try {
            $updates = [];

            if (empty($resort->latitude)) {
                $updates['latitude'] = $coordinates['latitude'];
            }

            if (empty($resort->longitude)) {
                $updates['longitude'] = $coordinates['longitude'];
            }

            if (!empty($coordinates['timezone']) && empty($resort->timezone)) {
                $updates['timezone'] = $coordinates['timezone'];
            }

            if (!empty($updates)) {
                $resort->update($updates);
                Log::info("Updated resort coordinates", [
                    'resort' => $resort->name,
                    'updates' => $updates
                ]);
            }

        } catch (Exception $e) {
            Log::error("Failed to save coordinates", [
                'resort' => $resort->name,
                'coordinates' => $coordinates,
                'error' => $e->getMessage()
            ]);
            throw $e;
        }
    }
}
