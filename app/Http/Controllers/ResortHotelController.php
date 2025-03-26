<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;
use App\Services\HotelMappingService;

class ResortHotelController extends Controller
{
    public function getRawHotelApiResponse(string $resortName)
    {
        $cityId = (new HotelMappingService())->getCityId($resortName);

        if (!$cityId) {
            Log::debug("\nFound city ID - End of Entry\n", [
                'location' => $resortName,
                'city_id' => null,
                'geo_name' => null
            ]);
            return ['error' => 'No city ID found'];
        }

        try {
            $params = [
                'cityid' => $cityId,
                'api_key' => config('services.makcorps.api_key'),
                'pagination' => 0,
                'cur' => 'USD',
                'rooms' => 1,
                'adults' => 2,
                'checkin' => now()->addDays(2)->format('Y-m-d'),
                'checkout' => now()->addDays(4)->format('Y-m-d')
            ];

            Log::debug("\nMaking hotels API request - Start of Entry\n", $params);
            Log::debug("\nRequest Details:\n", $params);

            $response = Http::withOptions(['debug' => false])
                ->retry(3, 100)
                ->get('https://api.makcorps.com/city', $params);

            Log::debug("\nHotels API response - Start of Entry\n", [
                'status' => $response->status(),
                'headers' => $response->headers()
            ]);

            Log::debug("\nResponse Body:\n", ['body' => $response->body()]);
            Log::debug("\nEnd of API Response Entry\n");

            if ($response->failed()) {
                return [
                    'error' => 'API request failed',
                    'status' => $response->status(),
                    'response' => $response->body(),
                    'request' => $params
                ];
            }

            $data = $response->json();

            if (empty($data)) {
                Log::debug("\nEmpty hotel data received - End of Entry\n", ['cityId' => $cityId]);
                return ['error' => 'No hotels found for this location'];
            }

            return $data;

        } catch (\Exception $e) {
            Log::debug("\nAPI Exception - Start of Entry\n", [
                'error' => $e->getMessage(),
                'trace' => $e->getTraceAsString()
            ]);
            Log::debug("\nEnd of Exception Entry\n");

            return [
                'error' => 'Service temporarily unavailable',
                'details' => app()->environment('local') ? $e->getMessage() : null
            ];
        }
    }
}
