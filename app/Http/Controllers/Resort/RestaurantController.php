<?php

namespace App\Http\Controllers\Resort;

use App\Http\Controllers\Controller;
use App\Services\RestaurantService;
use Illuminate\Support\Facades\Log;

class RestaurantController extends Controller
{
    public function __construct(
        protected RestaurantService $restaurantService
    ) {
        Log::debug('ResortRestaurantController initialized', ['service' => get_class($restaurantService)]);
    }

// In ResortRestaurantController.php
public function getRestaurants(string $resortName)
{
    try {
        Log::debug('Attempting to fetch restaurants', [
            'resort' => $resortName,
            'time' => now()->toDateTimeString()
        ]);

        $restaurants = $this->restaurantService->getByLocation($resortName);

        Log::debug('Restaurants API response', [
            'resort' => $resortName,
            'response_count' => is_countable($restaurants) ? count($restaurants) : 0,
            'response_sample' => $restaurants[0] ?? null
        ]);

        // Remove response()->json() and just return the array
        return $restaurants;

    } catch (\Exception $e) {
        Log::error("Restaurant API failed for {$resortName}", [
            'error' => $e->getMessage(),
            'trace' => $e->getTraceAsString(),
            'time' => now()->toDateTimeString()
        ]);

        // Return an empty array on error
        return [];
    }
}
}
