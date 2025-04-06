<?php

namespace App\Http\Controllers\Resort;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Continent;
use App\Models\Country;
use App\Models\State;
use App\Models\Town;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Inertia\Inertia;

class TownCategoriesController extends Controller
{
    public function general($continentSlug, $countrySlug, $stateSlug, $townSlug)
    {
        $town = Town::with([
            'state.country.continent',
            'resorts'
        ])->where('slug', $townSlug)
          ->firstOrFail();

        return Inertia::render('town/General', [
            'currentView' => 'general',
            'continent' => $town->state->country->continent,
            'country' => $town->state->country,
            'state' => $town->state,
            'town' => $town,
            'category' => [
                'name' => 'General',
                'slug' => 'general'
            ]
        ]);
    }

    public function events($continentSlug, $countrySlug, $stateSlug, $townSlug)
    {
        $town = Town::with([
            'state.country.continent',
            'resorts'
        ])->where('slug', $townSlug)
          ->firstOrFail();

        return Inertia::render('town/Events', [
            'currentView' => 'events',
            'continent' => $town->state->country->continent,
            'country' => $town->state->country,
            'state' => $town->state,
            'town' => $town,
            'category' => [
                'name' => 'Events',
                'slug' => 'events'
            ]
        ]);
    }

    public function weather($continentSlug, $countrySlug, $stateSlug, $townSlug)
    {
        $town = Town::with([
            'state.country.continent',
            'resorts'
        ])->where('slug', $townSlug)
          ->firstOrFail();

        return Inertia::render('town/Weather', [
            'currentView' => 'weather',
            'continent' => $town->state->country->continent,
            'country' => $town->state->country,
            'state' => $town->state,
            'town' => $town,
            'category' => [
                'name' => 'Weather',
                'slug' => 'weather'
            ]
        ]);
    }

    public function resort($continentSlug, $countrySlug, $stateSlug, $townSlug)
    {
        $town = Town::with([
            'state.country.continent',
            'resorts'
        ])->where('slug', $townSlug)
          ->firstOrFail();

        return Inertia::render('town/Resort', [
            'currentView' => 'resort',
            'continent' => $town->state->country->continent,
            'country' => $town->state->country,
            'state' => $town->state,
            'town' => $town,
            'category' => [
                'name' => 'Resort',
                'slug' => 'resort'
            ]
        ]);
    }

    public function backcountry($continentSlug, $countrySlug, $stateSlug, $townSlug)
    {
        $town = Town::with([
            'state.country.continent',
            'resorts'
        ])->where('slug', $townSlug)
          ->firstOrFail();

        return Inertia::render('town/Backcountry', [
            'currentView' => 'backcountry',
            'continent' => $town->state->country->continent,
            'country' => $town->state->country,
            'state' => $town->state,
            'town' => $town,
            'category' => [
                'name' => 'Backcountry',
                'slug' => 'backcountry'
            ]
        ]);
    }

    public function forums($continentSlug, $countrySlug, $stateSlug, $townSlug)
    {
        $town = Town::with([
            'state.country.continent',
            'resorts'
        ])->where('slug', $townSlug)
          ->firstOrFail();

        return Inertia::render('town/Forums', [
            'currentView' => 'forums',
            'continent' => $town->state->country->continent,
            'country' => $town->state->country,
            'state' => $town->state,
            'town' => $town,
            'category' => [
                'name' => 'Forums',
                'slug' => 'forums'
            ]
        ]);
    }

    public function arts($continentSlug, $countrySlug, $stateSlug, $townSlug)
    {
        $town = Town::with([
            'state.country.continent',
            'resorts'
        ])->where('slug', $townSlug)
          ->firstOrFail();

        return Inertia::render('town/Arts', [
            'currentView' => 'arts',
            'continent' => $town->state->country->continent,
            'country' => $town->state->country,
            'state' => $town->state,
            'town' => $town,
            'category' => [
                'name' => 'Arts',
                'slug' => 'arts'
            ]
        ]);
    }

    public function activities($continentSlug, $countrySlug, $stateSlug, $townSlug)
    {
        $town = Town::with([
            'state.country.continent',
            'resorts'
        ])->where('slug', $townSlug)
          ->firstOrFail();

        return Inertia::render('town/Activities', [
            'currentView' => 'activities',
            'continent' => $town->state->country->continent,
            'country' => $town->state->country,
            'state' => $town->state,
            'town' => $town,
            'category' => [
                'name' => 'Activities',
                'slug' => 'activities'
            ]
        ]);
    }

    public function accomodation($continentSlug, $countrySlug, $stateSlug, $townSlug)
    {
        $town = Town::with([
            'state.country.continent',
            'resorts'
        ])->where('slug', $townSlug)
          ->firstOrFail();

        return Inertia::render('town/Accomodation', [
            'currentView' => 'accomodation',
            'continent' => $town->state->country->continent,
            'country' => $town->state->country,
            'state' => $town->state,
            'town' => $town,
            'category' => [
                'name' => 'Accomodation',
                'slug' => 'accomodation'
            ]
        ]);
    }

    public function food($continentSlug, $countrySlug, $stateSlug, $townSlug)
    {
        $town = Town::with([
            'state.country.continent',
            'resorts'
        ])->where('slug', $townSlug)
          ->firstOrFail();

        return Inertia::render('town/Food', [
            'currentView' => 'food',
            'continent' => $town->state->country->continent,
            'country' => $town->state->country,
            'state' => $town->state,
            'town' => $town,
            'category' => [
                'name' => 'Food',
                'slug' => 'food'
            ]
        ]);
    }

    public function transport($continentSlug, $countrySlug, $stateSlug, $townSlug)
    {
        $town = Town::with([
            'state.country.continent',
            'resorts'
        ])->where('slug', $townSlug)
          ->firstOrFail();

        return Inertia::render('town/Transport', [
            'currentView' => 'transport',
            'continent' => $town->state->country->continent,
            'country' => $town->state->country,
            'state' => $town->state,
            'town' => $town,
            'category' => [
                'name' => 'Transport',
                'slug' => 'transport'
            ]
        ]);
    }

    public function jobs($continentSlug, $countrySlug, $stateSlug, $townSlug)
    {
        $town = Town::with([
            'state.country.continent',
            'resorts'
        ])->where('slug', $townSlug)
          ->firstOrFail();

        return Inertia::render('town/Jobs', [
            'currentView' => 'jobs',
            'continent' => $town->state->country->continent,
            'country' => $town->state->country,
            'state' => $town->state,
            'town' => $town,
            'category' => [
                'name' => 'Jobs',
                'slug' => 'jobs'
            ]
        ]);
    }

    public function marketplace($continentSlug, $countrySlug, $stateSlug, $townSlug)
    {
        $town = Town::with([
            'state.country.continent',
            'resorts'
        ])->where('slug', $townSlug)
          ->firstOrFail();

        return Inertia::render('town/Marketplace', [
            'currentView' => 'marketplace',
            'continent' => $town->state->country->continent,
            'country' => $town->state->country,
            'state' => $town->state,
            'town' => $town,
            'category' => [
                'name' => 'Marketplace',
                'slug' => 'marketplace'
            ]
        ]);
    }

    public function companies($continentSlug, $countrySlug, $stateSlug, $townSlug)
    {
        $town = Town::with([
            'state.country.continent',
            'resorts'
        ])->where('slug', $townSlug)
          ->firstOrFail();

        return Inertia::render('town/Companies', [
            'currentView' => 'companies',
            'continent' => $town->state->country->continent,
            'country' => $town->state->country,
            'state' => $town->state,
            'town' => $town,
            'category' => [
                'name' => 'Companies',
                'slug' => 'companies'
            ]
        ]);
    }

    public function fitness($continentSlug, $countrySlug, $stateSlug, $townSlug)
    {
        $town = Town::with([
            'state.country.continent',
            'resorts'
        ])->where('slug', $townSlug)
          ->firstOrFail();

        return Inertia::render('town/Fitness', [
            'currentView' => 'fitness',
            'continent' => $town->state->country->continent,
            'country' => $town->state->country,
            'state' => $town->state,
            'town' => $town,
            'category' => [
                'name' => 'Fitness',
                'slug' => 'fitness'
            ]
        ]);
    }

    public function content($continentSlug, $countrySlug, $stateSlug, $townSlug)
    {
        $town = Town::with([
            'state.country.continent',
            'resorts'
        ])->where('slug', $townSlug)
          ->firstOrFail();

        return Inertia::render('town/Content', [
            'currentView' => 'content',
            'continent' => $town->state->country->continent,
            'country' => $town->state->country,
            'state' => $town->state,
            'town' => $town,
            'category' => [
                'name' => 'Content',
                'slug' => 'content'
            ]
        ]);
    }

    public function atm($continentSlug, $countrySlug, $stateSlug, $townSlug)
    {
        $town = Town::with([
            'state.country.continent',
            'resorts'
        ])->where('slug', $townSlug)
          ->firstOrFail();

        return Inertia::render('town/Atm', [
            'currentView' => 'atm',
            'continent' => $town->state->country->continent,
            'country' => $town->state->country,
            'state' => $town->state,
            'town' => $town,
            'category' => [
                'name' => 'Atm',
                'slug' => 'atm'
            ]
        ]);
    }

    public function maps($continentSlug, $countrySlug, $stateSlug, $townSlug)
    {
        $town = Town::with([
            'state.country.continent',
            'resorts'
        ])->where('slug', $townSlug)
          ->firstOrFail();

        return Inertia::render('town/Maps', [
            'currentView' => 'maps',
            'continent' => $town->state->country->continent,
            'country' => $town->state->country,
            'state' => $town->state,
            'town' => $town,
            'category' => [
                'name' => 'Maps',
                'slug' => 'maps'
            ]
        ]);
    }

    public function rentals($continentSlug, $countrySlug, $stateSlug, $townSlug)
    {
        $town = Town::with([
            'state.country.continent',
            'resorts'
        ])->where('slug', $townSlug)
          ->firstOrFail();

        return Inertia::render('town/Rentals', [
            'currentView' => 'rentals',
            'continent' => $town->state->country->continent,
            'country' => $town->state->country,
            'state' => $town->state,
            'town' => $town,
            'category' => [
                'name' => 'Rentals',
                'slug' => 'rentals'
            ]
        ]);
    }
    
}
