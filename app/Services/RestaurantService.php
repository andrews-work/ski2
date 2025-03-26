<?php

namespace App\Services;

use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class RestaurantService
{
    public function getByLocation(string $location, string $api = 'yelp')
    {
        Log::debug('RestaurantService: getByLocation called', [
            'location' => $location,
            'selected_api' => $api
        ]);

        try {
            $result = match ($api) {
                'yelp' => $this->getFromYelp($location),
                default => throw new \Exception("API not supported: {$api}"),
            };

            Log::debug('RestaurantService: API call successful', [
                'location' => $location,
                'result_count' => is_countable($result) ? count($result) : 'non-countable'
            ]);

            return $result;

        } catch (\Exception $e) {
            Log::error('RestaurantService: Failed to fetch restaurants', [
                'location' => $location,
                'error' => $e->getMessage(),
                'trace' => $e->getTraceAsString()
            ]);
            throw $e;
        }
    }

    protected function getFromYelp(string $location)
    {
        $apiKey = config('services.yelp.api_key');

        if (empty($apiKey)) {
            Log::critical('Yelp API key missing in configuration');
            throw new \Exception('Yelp API key not configured');
        }

        $params = [
            'location' => $location,
            'categories' => 'restaurants',
            'sort_by' => 'rating',
            'limit' => 20,
        ];

        Log::debug('Preparing Yelp API request', [
            'endpoint' => 'https://api.yelp.com/v3/businesses/search',
            'params' => $params,
            'time' => now()->toDateTimeString()
        ]);

        $response = Http::withHeaders([
            'Authorization' => 'Bearer ' . $apiKey,
        ])->get('https://api.yelp.com/v3/businesses/search', $params);

        Log::debug('Yelp API raw response', [
            'status' => $response->status(),
            'headers' => $response->headers(),
            'body_sample' => substr($response->body(), 0, 200) // First 200 chars of response
        ]);

        if ($response->failed()) {
            Log::error('Yelp API request failed', [
                'status' => $response->status(),
                'error' => $response->json()['error'] ?? 'Unknown error',
                'full_response' => $response->json()
            ]);
            return [];
        }

        $data = $response->json();

        if (!isset($data['businesses'])) {
            Log::warning('Yelp API returned unexpected format', [
                'response_keys' => array_keys($data),
                'full_response' => $data
            ]);
            return [];
        }

        return $data['businesses'];
    }
}
