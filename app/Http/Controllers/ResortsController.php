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
        $resorts = [];
        $towns = [];

        return Inertia::render('Resorts', [
            'currentView' => 'state',
            'continent' => $continent,
            'country' => $country,
            'states' => $states,
            'resorts' => $resorts,
            'towns' => $towns,
            'continents' => [],
            'categories' => [],
        ]);
    }

    // list of towns
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
        $town = Town::with([
            'state.country.continent',
            'resorts'
        ])->where('slug', $townSlug)
          ->firstOrFail();

        $resort = $town->resorts->sortByDesc('is_primary')->first();
        Log::info('resort' . $resort);
        Log::info('resort' . $town);

        return Inertia::render('Resorts', [
            'currentView' => 'town',
            'continents' => [],
            'continent' => $town->state->country->continent,
            'country' => $town->state->country,
            'state' => $town->state,
            'town' => $town,
            'resort' => $resort,
            'resorts' => $town->resorts,
            'categories' => Category::all(),
        ]);
    }

    public function resort($continentSlug, $countrySlug, $stateSlug, $townSlug, $resortSlug)
    {
        Log::info('loading resort');
        $resort = Resort::with([
            'town.state.country.continent',
            'categories'
        ])->where('slug', $resortSlug)->first();

        if (!$resort) {
            return redirect()->back()->with('error', 'Resort not found.');
        }

        $categories = Category::all();

        return Inertia::render('Resorts', [
            'currentView' => 'resort',
            'continents' => [],
            'continent' => $resort->town->state->country->continent,
            'countries' => [],
            'country' => $resort->town->state->country, // Fixed typo here
            'town' => $resort->town,
            'resort' => $resort,
            'categories' => $categories,
        ]);
    }
}
