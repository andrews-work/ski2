<?php

namespace App\Http\Controllers\Forums;

use App\Http\Controllers\Controller;
use App\Models\Forums\CategoryListModel;
use Illuminate\Support\Facades\Log;
use Inertia\Inertia;

class ResortsCategoryController extends Controller
{
    // Fetch all top-level categories
    protected function getCategories()
    {
        Log::info('ResortsCategoryController - getCategories');
        return CategoryListModel::whereNull('parent_id')->get();
    }

    // Show the resorts category (top-level)
    public function showResorts()
    {
        Log::info('ResortsCategoryController - showResorts called');

        // Fetch the resorts category
        $resortsCategory = CategoryListModel::where('slug', 'resorts')->firstOrFail();
        Log::info('Resorts category fetched:', ['resortsCategory' => $resortsCategory]);

        // Fetch all continents (direct children of resorts category)
        $continents = $resortsCategory->children()->where('type', 'continent')->get();
        Log::info('Continents fetched:', ['continents' => $continents]);

        // Fetch all top-level categories
        $categories = $this->getCategories();

        return inertia('Forums', [
            'category' => $resortsCategory,
            'continents' => $continents,
            'categories' => $categories, // Add this line
        ]);
    }

    // Show a continent
    public function showContinent($continentSlug)
    {
        Log::info('ResortsCategoryController - showContinent called', [
            'continentSlug' => $continentSlug,
        ]);

        // Fetch the resorts category
        $resortsCategory = CategoryListModel::where('slug', 'resorts')->firstOrFail();
        Log::info('Resorts category fetched:', ['resortsCategory' => $resortsCategory]);

        // Fetch the continent
        $continent = CategoryListModel::where('slug', $continentSlug)
            ->where('parent_id', $resortsCategory->id)
            ->where('type', 'continent')
            ->firstOrFail();
        Log::info('Continent fetched:', ['continent' => $continent]);

        // Fetch all countries (direct children of the continent)
        $countries = $continent->children()->where('type', 'country')->get();
        Log::info('Countries fetched:', ['countries' => $countries]);

        // Fetch all top-level categories
        $categories = $this->getCategories();

        return inertia('Forums', [
            'category' => $resortsCategory,
            'continent' => $continent,
            'countries' => $countries,
            'categories' => $categories, // Add this line
        ]);
    }

    // Show a country
    public function showCountry($continentSlug, $countrySlug)
    {
        Log::info('ResortsCategoryController - showCountry called', [
            'continentSlug' => $continentSlug,
            'countrySlug' => $countrySlug,
        ]);

        // Fetch the resorts category
        $resortsCategory = CategoryListModel::where('slug', 'resorts')->firstOrFail();
        Log::info('Resorts category fetched:', ['resortsCategory' => $resortsCategory]);

        // Fetch the continent
        $continent = CategoryListModel::where('slug', $continentSlug)
            ->where('parent_id', $resortsCategory->id)
            ->where('type', 'continent')
            ->firstOrFail();
        Log::info('Continent fetched:', ['continent' => $continent]);

        // Fetch the country
        $country = CategoryListModel::where('slug', $countrySlug)
            ->where('parent_id', $continent->id)
            ->where('type', 'country')
            ->firstOrFail();
        Log::info('Country fetched:', ['country' => $country]);

        // Fetch all resorts (direct children of the country)
        $resorts = $country->children()->where('type', 'resort')->get();
        Log::info('Resorts fetched:', ['resorts' => $resorts]);

        // Fetch all top-level categories
        $categories = $this->getCategories();

        return inertia('Forums', [
            'category' => $resortsCategory,
            'continent' => $continent,
            'country' => $country,
            'resorts' => $resorts,
            'categories' => $categories, // Add this line
        ]);
    }

    // Show a resort
    public function showResort($continentSlug, $countrySlug, $resortSlug)
    {
        Log::info('ResortsCategoryController - showResort called', [
            'continentSlug' => $continentSlug,
            'countrySlug' => $countrySlug,
            'resortSlug' => $resortSlug,
        ]);

        // Fetch the resorts category
        $resortsCategory = CategoryListModel::where('slug', 'resorts')->firstOrFail();
        Log::info('Resorts category fetched:', ['resortsCategory' => $resortsCategory]);

        // Fetch the continent
        $continent = CategoryListModel::where('slug', $continentSlug)
            ->where('parent_id', $resortsCategory->id)
            ->where('type', 'continent')
            ->firstOrFail();
        Log::info('Continent fetched:', ['continent' => $continent]);

        // Fetch the country
        $country = CategoryListModel::where('slug', $countrySlug)
            ->where('parent_id', $continent->id)
            ->where('type', 'country')
            ->firstOrFail();
        Log::info('Country fetched:', ['country' => $country]);

        // Fetch the resort
        $resort = CategoryListModel::where('slug', $resortSlug)
            ->where('parent_id', $country->id)
            ->where('type', 'resort')
            ->firstOrFail();
        Log::info('Resort fetched:', ['resort' => $resort]);

        // Fetch all top-level categories
        $categories = $this->getCategories();

        return inertia('Forums', [
            'category' => $resortsCategory,
            'continent' => $continent,
            'country' => $country,
            'resort' => $resort,
            'categories' => $categories, // Add this line
        ]);
    }
}
