<?php

namespace App\Http\Controllers\Resort;

use App\Http\Controllers\Controller;
use App\Models\Resort;
use Exception;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;
use Carbon\Carbon;

class InfoController extends Controller
{
    public function getResortData($resortName)
    {
        try {
            $resort = Resort::where('name', $resortName)->firstOrFail();
            Log::info("Fetching data for resort", ['resort' => $resortName]);

            // First get the basic geo data
            $apiData = $this->getApiData($resortName);

            Log::debug("GeoAPI Response Data", [
                'resort' => $resortName,
                'api_data' => $apiData,
                'existing_resort_data' => [
                    'latitude' => $resort->latitude,
                    'longitude' => $resort->longitude,
                    'elevation' => $resort->base_elevation,
                    'timezone' => $resort->timezone,
                    'country' => $resort->country,
                    'state' => $resort->state,
                    'state_code' => $resort->state_code,
                    'local_time' => $resort->local_time
                ]
            ]);

            // Handle coordinates first (needed for elevation)
            if (!$this->hasCoordinates($resort)) {
                $this->saveLatLong($resort, [
                    'latitude' => $apiData['latitude'],
                    'longitude' => $apiData['longitude']
                ]);

                // Refresh resort data after update
                $resort->refresh();
            }

            // Now handle elevation - only fetch if we don't have it
            if (!$this->hasElevation($resort)) {
                // Get elevation using the coordinates (either just fetched or existing)
                $elevation = $this->fetchElevation(
                    $resort->latitude,
                    $resort->longitude
                );

                if ($elevation !== null) {
                    $this->saveElevation($resort, $elevation);
                }
            }

            // Handle other data (timezone, location details)
            if (!$this->hasTimezone($resort) && isset($apiData['timezone'])) {
                $this->saveTimezone($resort, $apiData['timezone']);
                $this->updateLocalTime($resort, $apiData['timezone']);
            }

            if (!$this->hasLocationDetails($resort)) {
                $locationUpdates = [];
                if (isset($apiData['country'])) $locationUpdates['country'] = $apiData['country'];
                if (isset($apiData['state'])) $locationUpdates['state'] = $apiData['state'];
                if (isset($apiData['state_code'])) $locationUpdates['state_code'] = $apiData['state_code'];

                if (!empty($locationUpdates)) {
                    $this->saveLocationDetails($resort, $locationUpdates);
                }
            }

            $responseData = [
                'status' => 'success',
                'resort' => $resort->fresh(),
                'message' => 'Resort data updated successfully'
            ];

            Log::debug("Data being sent to frontend", [
                'resort' => $resortName,
                'response_data' => $responseData
            ]);

            return $responseData;

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

    private function getApiData($resortName): array
    {
        $response = $this->apiCall($resortName);

        if (empty($response['results'])) {
            throw new Exception("No results returned from API");
        }

        $result = $response['results'][0];

        Log::debug("Raw GeoAPI Response", [
            'resort' => $resortName,
            'full_response' => $response,
            'selected_result' => $result
        ]);

        return [
            'latitude' => $result['lat'] ?? null,
            'longitude' => $result['lon'] ?? null,
            'timezone' => $result['timezone']['name'] ?? null,
            'country' => $result['country'] ?? null,
            'state' => $result['state'] ?? null,
            'state_code' => $result['state_code'] ?? null
        ];
    }

    private function hasCoordinates(Resort $resort): bool
    {
        return !empty($resort->latitude) && !empty($resort->longitude);
    }

    private function saveLatLong(Resort $resort, array $coordinates): void
    {
        try {
            $updates = [];

            if (empty($resort->latitude) && isset($coordinates['latitude'])) {
                $updates['latitude'] = $coordinates['latitude'];
            }

            if (empty($resort->longitude) && isset($coordinates['longitude'])) {
                $updates['longitude'] = $coordinates['longitude'];
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

    private function hasElevation(Resort $resort): bool
    {
        return !empty($resort->base_elevation);
    }

    private function fetchElevation(float $latitude, float $longitude): ?float
    {
        try {
            $baseUrl = config('services.open_meteo.base_url');
            $url = $baseUrl . 'elevation?' . http_build_query([
                'latitude' => $latitude,
                'longitude' => $longitude
            ]);

            Log::debug("Fetching elevation from API", [
                'url' => $url,
                'latitude' => $latitude,
                'longitude' => $longitude
            ]);

            $response = Http::get($url);

            if ($response->successful()) {
                $data = $response->json();
                Log::debug("Raw elevation API response", ['response' => $data]);

                // Handle both array and direct elevation responses
                $elevationValue = null;
                if (isset($data['elevation'])) {
                    if (is_array($data['elevation']) && count($data['elevation']) > 0) {
                        $elevationValue = (float)$data['elevation'][0];
                    } elseif (is_numeric($data['elevation'])) {
                        $elevationValue = (float)$data['elevation'];
                    }
                }

                if ($elevationValue !== null) {
                    Log::info("Successfully fetched elevation", [
                        'latitude' => $latitude,
                        'longitude' => $longitude,
                        'elevation' => $elevationValue
                    ]);
                    return $elevationValue;
                }

                Log::warning("Elevation data missing or invalid in API response", [
                    'latitude' => $latitude,
                    'longitude' => $longitude,
                    'response' => $data
                ]);
            } else {
                Log::warning("Elevation API request failed", [
                    'status' => $response->status(),
                    'response' => $response->body(),
                    'latitude' => $latitude,
                    'longitude' => $longitude,
                ]);
            }

            return null;
        } catch (Exception $e) {
            Log::error("Failed to fetch elevation", [
                'error' => $e->getMessage(),
                'latitude' => $latitude,
                'longitude' => $longitude,
                'trace' => $e->getTraceAsString()
            ]);
            return null;
        }
    }

    private function saveElevation(Resort $resort, ?float $elevation): void
    {
        try {
            if (!$this->hasElevation($resort) && $elevation !== null && $elevation > 0) {
                $resort->update(['base_elevation' => $elevation]);
                Log::info("Updated resort elevation", [
                    'resort' => $resort->name,
                    'elevation' => $elevation
                ]);
            }
        } catch (Exception $e) {
            Log::error("Failed to save elevation", [
                'resort' => $resort->name,
                'elevation' => $elevation,
                'error' => $e->getMessage()
            ]);
            throw $e;
        }
    }

    private function updateLocalTime(Resort $resort, string $timezone): void
    {
        try {
            $localTime = Carbon::now($timezone)->format('G:i a');
            $resort->update(['local_time' => $localTime]);

            Log::info("Updated resort local time", [
                'resort' => $resort->name,
                'timezone' => $timezone,
                'local_time' => $localTime
            ]);
        } catch (Exception $e) {
            Log::error("Failed to update local time", [
                'resort' => $resort->name,
                'error' => $e->getMessage()
            ]);
        }
    }

    private function hasTimezone(Resort $resort): bool
    {
        return !empty($resort->timezone);
    }

    private function saveTimezone(Resort $resort, ?string $timezone): void
    {
        try {
            if (!$this->hasTimezone($resort) && $timezone !== null) {
                $resort->update(['timezone' => $timezone]);
                Log::info("Updated resort timezone", [
                    'resort' => $resort->name,
                    'timezone' => $timezone
                ]);
            }
        } catch (Exception $e) {
            Log::error("Failed to save timezone", [
                'resort' => $resort->name,
                'timezone' => $timezone,
                'error' => $e->getMessage()
            ]);
            throw $e;
        }
    }

    private function hasLocationDetails(Resort $resort): bool
    {
        return !empty($resort->country) && !empty($resort->state) && !empty($resort->state_code);
    }

    private function saveLocationDetails(Resort $resort, array $locationDetails): void
    {
        try {
            $updates = [];

            if (empty($resort->country) && isset($locationDetails['country'])) {
                $updates['country'] = $locationDetails['country'];
            }

            if (empty($resort->state) && isset($locationDetails['state'])) {
                $updates['state'] = $locationDetails['state'];
            }

            if (empty($resort->state_code) && isset($locationDetails['state_code'])) {
                $updates['state_code'] = $locationDetails['state_code'];
            }

            if (!empty($updates)) {
                $resort->update($updates);
                Log::info("Updated resort location details", [
                    'resort' => $resort->name,
                    'updates' => $updates
                ]);
            }
        } catch (Exception $e) {
            Log::error("Failed to save location details", [
                'resort' => $resort->name,
                'locationDetails' => $locationDetails,
                'error' => $e->getMessage()
            ]);
            throw $e;
        }
    }
}
