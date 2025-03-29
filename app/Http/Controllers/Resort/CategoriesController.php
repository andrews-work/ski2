<?php

namespace App\Http\Controllers\Resort;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Resort\HotelController;
use App\Http\Controllers\Resort\InfoController;
use App\Http\Controllers\Resort\RestaurantController;
use Inertia\Inertia;
use App\Models\Resort;
use Exception;
use Illuminate\Support\Facades\Log;

class CategoriesController extends Controller
{
    public function info($continentSlug, $countrySlug, $resortSlug)
    {
        $resort = Resort::where('slug', $resortSlug)->firstOrFail();

        $infoController = new InfoController();
        $resortData = $infoController->getResortData($resort->name);

        return Inertia::render('resort/Info', [
            'currentView' => 'info',
            'continent' => $resort->country->continent,
            'country' => $resort->country,
            'resort' => $resort->fresh(),
            'debug' => $resortData
        ]);
    }

    public function forums($continentSlug, $countrySlug, $resortSlug)
    {
        return redirect('/forums/categories/resorts/' . $continentSlug . '/' . $countrySlug . '/' . $resortSlug);

        return redirect()->route('forums.categories.resortsPage', [
            'continentSlug' => $continentSlug,
            'countrySlug' => $countrySlug,
            'resortSlug' => $resortSlug
        ]);
    }

    public function hotels($continentSlug, $countrySlug, $resortSlug, HotelController $hotelController)
    {
        try {
            $resort = Resort::where('slug', $resortSlug)->firstOrFail();
            $apiResponse = $hotelController->getRawHotelApiResponse($resort->name);

            return Inertia::render('resort/Hotels', [
                'currentView' => 'hotels',
                'continent' => $resort->country->continent,
                'country' => $resort->country,
                'resort' => $resort,
                'hotels' => $apiResponse,
                'debug' => true
            ]);

        } catch (Exception $e) {
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

    public function restaurants($continentSlug, $countrySlug, $resortSlug, RestaurantController $restaurantController)
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
                'debug' => true
            ]);

        } catch (Exception $e) {
            Log::error("Restaurants API failed for {$resortSlug}", [
                'error' => $e->getMessage()
            ]);

            return Inertia::render('resort/Restaurants', [
                'currentView' => 'restaurants',
                'continent' => null,
                'country' => null,
                'resort' => null,
                'restaurants' => ['error' => $e->getMessage()],
                'debug' => true
            ]);
        }
    }

    public function business($continentSlug, $countrySlug, $resortSlug)
    {
        try {
            $resort = Resort::where('slug', $resortSlug)->firstOrFail();
            return Inertia::render('resort/Business', [
                'currentView' => 'business',
                'continent' => $resort->country->continent,
                'country' => $resort->country,
                'resort' => $resort,
                'debug' => true
            ]);
        } catch (Exception $e) {
            Log::error("business page failed for {$resortSlug}", [
                'error' => $e->getMessage()
            ]);
        }
    }

    public function jobs($continentSlug, $countrySlug, $resortSlug)
    {
        try {
            $resort = Resort::where('slug', $resortSlug)->firstOrFail();
            return Inertia::render('resort/Jobs', [
                'currentView' => 'jobs',
                'continent' => $resort->country->continent,
                'country' => $resort->country,
                'resort' => $resort,
                'debug' => true
            ]);
        } catch (Exception $e) {
            Log::error("jobs page failed for {$resortSlug}", [
                'error' => $e->getMessage()
            ]);
        }
    }

    public function weather($continentSlug, $countrySlug, $resortSlug, WeatherController $weatherController)
    {
        try {
            $resort = Resort::where('slug', $resortSlug)->firstOrFail();
            $weatherData = $weatherController->getWeather($resort->name);

            return Inertia::render('resort/Weather', [
                'currentView' => 'weather',
                'continent' => $resort->country->continent,
                'country' => $resort->country,
                'resort' => $resort,
                'debug' => true,
                'weatherData' => $weatherData,
            ]);

        } catch (Exception $e) {
            Log::error("Weather page failed for {$resortSlug}", [
                'error' => $e->getMessage()
            ]);

            return Inertia::render('resort/Weather', [
                'currentView' => 'weather',
                'continent' => null,
                'country' => null,
                'resort' => null,
                'weatherData' => ['error' => $e->getMessage()],
                'debug' => true
            ]);
        }
    }
}




