<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Inertia\Inertia;
use App\Models\Continent;
use App\Models\Country;
use App\Models\Resort;
use App\Models\State;
use App\Models\Town;
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
        $continents = Continent::withCount('countries as count')->get();

        return Inertia::render('Resorts', [
            'currentView' => 'continents',
            'continents' => $continents,
            'categories' => [],
        ]);
    }

    public function countries($continentSlug)
    {
        $continent = Continent::where('slug', $continentSlug)->firstOrFail();

        $countries = $continent->countries()
            ->with(['states.towns.resorts'])
            ->get();

        $states = State::whereIn('country_id', $countries->pluck('id'))
            ->with(['towns.resorts'])
            ->get();

        $towns = Town::whereIn('state_id', $states->pluck('id'))
            ->with(['resorts', 'state']) 
            ->get();

        $resorts = Resort::whereIn('town_id', $towns->pluck('id'))
            ->with(['town.state'])
            ->get();

        return Inertia::render('Resorts', [
            'currentView' => 'country',
            'continent' => $continent,
            'countries' => $countries,
            'country' => $countries->first(),
            'states' => $states,
            'towns' => $towns,
            'resorts' => $resorts,
            'continents' => [],
            'categories' => [],
        ]);
    }

    public function states($continentSlug, $countrySlug)
    {
        $continent = Continent::where('slug', $continentSlug)->first();
        $country = Country::where('slug', $countrySlug)->firstOrFail();
        $states = $country ? $country->states : [];

        return Inertia::render('Resorts', [
            'currentView' => 'state',
            'continent' => $continent,
            'country' => $country,
            'states' => $states,
            'continents' => [],
            'categories' => [],
        ]);
    }

    public function towns($continentSlug, $countrySlug, $stateSlug)
    {
        $continent = Continent::where('slug', $continentSlug)->first();
        $country = Country::where('slug', $countrySlug)->first();
        $state = State::where('slug', $stateSlug)->first();
        $towns = $state ? $state->towns : [];

        return Inertia::render('Resorts', [
            'currentView' => 'towns',
            'continent' => $continent,
            'country' => $country,
            'state' => $state,
            'towns' => $towns,
            'continents' => [],
            'categories' => [],
        ]);
    }

    public function town($continentSlug, $countrySlug, $stateSlug, $townSlug)
    {
        $continent = Continent::where('slug', $continentSlug)->first();
        $country = Country::where('slug', $countrySlug)->first();
        $state = State::where('slug', $stateSlug)->first();
        $town = Town::where('slug', $townSlug)->first();

        if (!$town) {
            return redirect()->back()->with('error', 'Town not found.');
        }

        $resort = Resort::where('town_id', $town->id)->first();
        $categories = Category::all();
        $continents = Continent::all();

        return Inertia::render('Resorts', [
            'currentView' => 'town',
            'continents' => $continents,
            'continent' => $continent,
            'country' => $country,
            'state' => $state,
            'town' => $town,
            'resort' => $resort,
            'categories' => $categories,
        ]);
    }

    public function resort($continentSlug, $countrySlug, $stateSlug, $townSlug, $resortSlug)
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
            'continents' => [],
            'continent' => $continent,
            'countries' => [],
            'country' => $country,
            'resort' => $resort,
            'categories' => $categories,
        ]);
    }
}
