<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class ResortRestaurantController extends Controller
{
    public function getRestaurants($locationName)
    {
        try {
            // Step 1: First get location ID
            $locationId = $this->getLocationId($locationName);

            if (!$locationId) {
                return ['error' => 'Location not found'];
            }

            // Step 2: Get restaurants for location
            $response = Http::withHeaders([
                'accept' => 'application/json'
            ])->get(config('services.tripadvisor.base_url').'/location/'.$locationId.'/restaurants', [
                'key' => config('services.tripadvisor.api_key'),
                'language' => 'en'
            ]);

            if ($response->successful()) {
                return $this->formatResponse($response->json());
            }

            Log::error('TripAdvisor API error', [
                'status' => $response->status(),
                'response' => $response->body()
            ]);

            return ['error' => 'Failed to fetch restaurants'];

        } catch (\Exception $e) {
            Log::error('TripAdvisor API exception', [
                'error' => $e->getMessage(),
                'location' => $locationName
            ]);

            return ['error' => 'Service temporarily unavailable'];
        }
    }

    private function getLocationId($locationName)
    {
        $response = Http::withHeaders([
            'accept' => 'application/json'
        ])->get(config('services.tripadvisor.base_url').'/location/search', [
            'key' => config('services.tripadvisor.api_key'),
            'searchQuery' => $locationName,
            'category' => 'hotels' // More likely to find resorts
        ]);

        return $response->successful()
            ? $response->json()['data'][0]['location_id']
            : null;
    }

    private function formatResponse($data)
    {
        return collect($data['data'])->map(function ($restaurant) {
            return [
                'name' => $restaurant['name'],
                'rating' => $restaurant['rating'],
                'price_level' => $restaurant['price_level'] ?? null,
                'cuisine' => $restaurant['cuisine'] ?? [],
                'address' => $restaurant['address_obj']['address_string'] ?? '',
                'photo' => $restaurant['photo']['images']['medium']['url'] ?? null,
                'tripadvisor_url' => $restaurant['web_url'] ?? null
            ];
        })->toArray();
    }
}
