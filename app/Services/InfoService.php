<?php

namespace App\Services;

use App\Models\Resort;
use Carbon\Carbon;
use Exception;
use Illuminate\Support\Facades\Log;

class InfoService
{
    protected $infoApiService;

    public function __construct(InfoApiService $infoApiService)
    {
        $this->infoApiService = $infoApiService;
    }

    public function getLatLong(Resort $resort): array
    {
        if ($resort->latitude && $resort->longitude) {
            return [
                'latitude' => $resort->latitude,
                'longitude' => $resort->longitude
            ];
        }

        $geoData = $this->infoApiService->fetchGeoData($resort->name);
        $result = $geoData['results'][0] ?? null;

        if ($result && isset($result['lat'], $result['lon'])) {
            $resort->update([
                'latitude' => $result['lat'],
                'longitude' => $result['lon']
            ]);

            return [
                'latitude' => $result['lat'],
                'longitude' => $result['lon']
            ];
        }

        throw new Exception("Could not fetch latitude/longitude for resort");
    }

    public function getLiftyData(Resort $resort): array
    {
        $rawData = $this->infoApiService->fetchLiftyData($resort);

        return [
            'lift_status' => $rawData['lifts']['status'] ?? [],
            'lift_stats' => $rawData['lifts']['stats'] ?? ['scheduled' => 0, 'closed' => 0, 'open' => 0],
            'lift_count' => $rawData['lifts']['count'] ?? count($rawData['lifts']['status'] ?? []),
            'weather' => $rawData['weather'] ?? null,
            'is_open' => $rawData['open'] ?? false
        ];
    }

    public function getTimezone(Resort $resort): string
    {
        if ($resort->timezone) {
            return $resort->timezone;
        }

        try {
            $geoData = $this->infoApiService->fetchGeoData($resort->name);
            $result = $geoData['results'][0] ?? null;

            if ($result && isset($result['timezone'])) {
                $timezone = $result['timezone']['name'] ?? null;
                if ($timezone) {
                    $resort->update(['timezone' => $timezone]);
                    return $timezone;
                }
            }

            Log::warning("No timezone found in geo data for resort {$resort->id}");
            return config('app.timezone', 'UTC');

        } catch (Exception $e) {
            Log::error("Error getting timezone for resort {$resort->id}: " . $e->getMessage());
            return config('app.timezone', 'UTC');
        }
    }

    public function getLocalTime(Resort $resort): array
    {
        $timezone = $this->getTimezone($resort);

        try {
            $now = Carbon::now($timezone);

            return [
                'timezone' => $timezone,
                'local_time' => $now->toDateTimeString(),
            ];

        } catch (Exception $e) {
            Log::warning("Failed to convert time for resort {$resort->id}", [
                'timezone' => $timezone,
                'error' => $e->getMessage()
            ]);

            return [
                'timezone' => $timezone,
                'error' => 'Could not determine local time'
            ];
        }
    }

    public function getStateInfo(Resort $resort): array
    {
        if ($resort->state && $resort->state_code) {
            return [
                'state' => $resort->state,
                'state_code' => $resort->state_code
            ];
        }

        $geoData = $this->infoApiService->fetchGeoData($resort->name);
        $result = $geoData['results'][0] ?? null;

        if ($result) {
            $updateData = array_filter([
                'state' => $result['state'] ?? null,
                'state_code' => $result['state_code'] ?? null
            ]);

            if (!empty($updateData)) {
                $resort->update($updateData);
            }

            return [
                'state' => $result['state'] ?? null,
                'state_code' => $result['state_code'] ?? null
            ];
        }

        return [
            'state' => null,
            'state_code' => null
        ];
    }

    public function getElevation(Resort $resort): ?float
    {
        if ($resort->base_elevation) {
            return $resort->base_elevation;
        }

        if (!$resort->latitude || !$resort->longitude) {
            return null;
        }

        $elevation = $this->infoApiService->fetchElevation(
            $resort->latitude,
            $resort->longitude
        );

        if ($elevation) {
            $resort->update(['base_elevation' => $elevation]);
        }

        return $elevation;
    }

    public function updateMinute($continentSlug, $countrySlug, $resortSlug)
    {
        try {
            $resort = Resort::where('slug', $resortSlug)->firstOrFail();

            return [
                'status' => 'success',
                'local_time' => $this->getLocalTime($resort),
                'lift_data' => $this->getLiftyData($resort),
                'message' => 'Resort info updated successfully'
            ];
        } catch (Exception $e) {
            Log::error("Failed to get updated resort info", [
                'resort' => $resortSlug,
                'error' => $e->getMessage()
            ]);

            return [
                'status' => 'error',
                'message' => 'Failed to fetch updated resort info'
            ];
        }
    }
}
