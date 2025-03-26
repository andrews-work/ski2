<?php

namespace App\Services;

use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class HotelMappingService
{
    public function getCityId(string $locationName): ?string
    {
        try {
            $response = Http::get('https://api.makcorps.com/mapping', [
                'api_key' => config('services.makcorps.api_key'),
                'name' => $locationName
            ]);

            if ($response->successful()) {
                $results = $response->json();

                foreach ($results as $result) {
                    if ($result['type'] === 'GEO') { 
                        Log::debug('Found city ID', [
                            'location' => $locationName,
                            'city_id' => $result['document_id'],
                            'geo_name' => $result['details']['geo_name'] ?? 'N/A'
                        ]);
                        return $result['document_id'];
                    }
                }
            }

            Log::warning('No city ID found', [
                'location' => $locationName,
                'response' => $response->body()
            ]);
            return null;

        } catch (\Exception $e) {
            Log::error('Mapping API failed', [
                'error' => $e->getMessage(),
                'location' => $locationName
            ]);
            return null;
        }
    }
}
