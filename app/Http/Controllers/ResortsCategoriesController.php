<?php

namespace App\Http\Controllers;

use Inertia\Inertia;
use App\Models\Resort;
use Illuminate\Support\Facades\Log;

class ResortsCategoriesController extends Controller
{
    public function info($continentSlug, $countrySlug, $resortSlug)
    {
        $resort = Resort::where('slug', $resortSlug)->first();

        if (!$resort) {
            return redirect()->back()->with('error', 'Resort not found.');
        }

        $country = $resort->country;
        $continent = $country->continent;

        // Fetch and save infobox data
        $resortInfoController = new ResortInfoController();
        $infoboxData = $resortInfoController->getInfoboxData($resort->name);

        // Reload the resort data to include updated fields
        $resort->refresh();

        return Inertia::render('resort/Info', [
            'currentView' => 'info',
            'continent' => $continent,
            'country' => $country,
            'resort' => $resort,
            'continents' => [],
            'countries' => [],
            'categories' => [],
        ]);
    }

    public function forums($continentSlug, $countrySlug, $resortSlug)
    {
        // Option 1: Using string concatenation
        return redirect('/forums/categories/resorts/' . $continentSlug . '/' . $countrySlug . '/' . $resortSlug);

        // OR Option 2: Using Laravel's route helper (recommended)
        return redirect()->route('forums.categories.resortsPage', [
            'continentSlug' => $continentSlug,
            'countrySlug' => $countrySlug,
            'resortSlug' => $resortSlug
        ]);
    }

    public function hotels($continentSlug, $countrySlug, $resortSlug)
    {
        try {
            $resort = Resort::where('slug', $resortSlug)->firstOrFail();

            // Get raw API response without transformation
            $hotelController = new ResortHotelController();
            $apiResponse = $hotelController->getRawHotelApiResponse($resort->name);

            // For debugging, return the raw API response
            return Inertia::render('resort/Hotels', [
                'currentView' => 'hotels',
                'continent' => $resort->country->continent,
                'country' => $resort->country,
                'resort' => $resort,
                'hotels' => $apiResponse,
                'debug' => true // Add flag to show raw response in frontend
            ]);

        } catch (\Exception $e) {
            return Inertia::render('resort/Hotels', [
                'currentView' => 'hotels',
                'continent' => null,
                'country' => null,
                'resort' => null,
                'hotels' => ['error' => $e->getMessage()],
                'debug' => true
            ]);
        }
    }

    public function restaurants($continentSlug, $countrySlug, $resortSlug, ResortRestaurantController $restaurantController)
    {
        try {
            $resort = Resort::where('slug', $resortSlug)->firstOrFail();
            $apiResponse = $restaurantController->getRestaurants($resort->name);

            return Inertia::render('resort/Restaurants', [
                'currentView' => 'restaurants',
                'continent' => $resort->country->continent,
                'country' => $resort->country,
                'resort' => $resort,
                'restaurants' => $apiResponse,
                'debug' => true,
            ]);

        } catch (\Exception $e) {
            Log::error("Restaurants API failed for {$resortSlug}", [
                'error' => $e->getMessage()
            ]);

            return Inertia::render('resort/Restaurants', [
                'currentView' => 'restaurants',
                'continent' => null,
                'country' => null,
                'resort' => null,
                'restaurants' => ['error' => $e->getMessage()],
                'debug' => true,
            ]);
        }
    }
}




