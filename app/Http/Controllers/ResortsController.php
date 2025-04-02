<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Inertia\Inertia;
use App\Models\Continent;
use App\Models\Country;
use App\Models\Resort;
use Illuminate\Support\Facades\Log;

class ResortsController extends Controller {

    public function index()
    {
        return Inertia::render('Resorts', [
            'currentView' => 'home',
            'continents' => [],
            'countries' => [],
            'categories' => [],
        ]);
    }

    public function continents()
    {
        $continents = Continent::all();
        return Inertia::render('Resorts', [
            'currentView' => 'continents',
            'continents' => $continents,
            'countries' => [],
            'categories' => [],
        ]);
    }

    public function countries($continentSlug) {
        $continent = Continent::where('slug', $continentSlug)->first();
        $countries = $continent ? $continent->countries : [];

        return Inertia::render('Resorts', [
            'currentView' => 'country',
            'continent' => $continent,
            'countries' => $countries,
            'continents' => [],
            'categories' => [],
        ]);
    }

    public function resorts($continentSlug, $countrySlug)
    {
        $country = Country::where('slug', $countrySlug)->first();

        if (!$country) {
            return redirect()->back()->with('error', 'Country not found.');
        }

        $continent = $country->continent;
        $resorts = Resort::where('country_id', $country->id)->get();

        return Inertia::render('Resorts', [
            'currentView' => 'resorts',
            'continent' => $continent,
            'country' => $country,
            'resorts' => $resorts,
            'continents' => [],
            'countries' => [],
            'categories' => [],
        ]);
    }

    public function resort($continentSlug, $countrySlug, $resortSlug)
    {
        $resort = Resort::where('slug', $resortSlug)->first();

        if (!$resort) {
            return redirect()->back()->with('error', 'Resort not found.');
        }

        $country = $resort->country;
        $continent = $country->continent;
        $categories = Category::all();

        return Inertia::render('Resorts', [
            'currentView' => 'resort',
            'continent' => $continent,
            'country' => $country,
            'resort' => $resort,
            'categories' => $categories,
            'continents' => [],
            'countries' => [],
        ]);
    }
}
