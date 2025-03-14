<?php

namespace App\Http\Controllers\Forums;

use App\Http\Controllers\Controller;
use App\Models\Forums\CategoryListModel;
use App\Models\Forums\PostModel;
use Illuminate\Support\Facades\Log;
use Inertia\Inertia;

class ResortsCategoryController extends Controller
{
    protected function getCategories()
    {
        Log::info('ResortsCategoryController - getCategories');
        return CategoryListModel::whereNull('parent_id')->get();
    }

    public function showResorts()
    {
        Log::info('ResortsCategoryController - showResorts called');

        $resortsCategory = CategoryListModel::where('slug', 'resorts')->firstOrFail();
        Log::info('Resorts category fetched:', ['resortsCategory' => $resortsCategory]);

        $continents = $resortsCategory->children()->where('type', 'continent')->get();
        Log::info('Continents fetched:', ['continents' => $continents]);

        $categories = $this->getCategories();

        return inertia('Forums', [
            'category' => $resortsCategory,
            'continents' => $continents,
            'categories' => $categories,
        ]);
    }

    public function showContinent($continentSlug)
    {
        Log::info('ResortsCategoryController - showContinent called', [
            'continentSlug' => $continentSlug,
        ]);

        $resortsCategory = CategoryListModel::where('slug', 'resorts')->firstOrFail();
        Log::info('Resorts category fetched:', ['resortsCategory' => $resortsCategory]);

        $continent = CategoryListModel::where('slug', $continentSlug)
            ->where('parent_id', $resortsCategory->id)
            ->where('type', 'continent')
            ->firstOrFail();
        Log::info('Continent fetched:', ['continent' => $continent]);

        $countries = $continent->children()->where('type', 'country')->get();
        Log::info('Countries fetched:', ['countries' => $countries]);

        $categories = $this->getCategories();

        return inertia('Forums', [
            'category' => $resortsCategory,
            'continent' => $continent,
            'countries' => $countries,
            'categories' => $categories,
        ]);
    }

    public function showCountry($continentSlug, $countrySlug)
    {
        Log::info('ResortsCategoryController - showCountry called', [
            'continentSlug' => $continentSlug,
            'countrySlug' => $countrySlug,
        ]);

        $resortsCategory = CategoryListModel::where('slug', 'resorts')->firstOrFail();
        Log::info('Resorts category fetched:', ['resortsCategory' => $resortsCategory]);

        $continent = CategoryListModel::where('slug', $continentSlug)
            ->where('parent_id', $resortsCategory->id)
            ->where('type', 'continent')
            ->firstOrFail();
        Log::info('Continent fetched:', ['continent' => $continent]);

        $country = CategoryListModel::where('slug', $countrySlug)
            ->where('parent_id', $continent->id)
            ->where('type', 'country')
            ->firstOrFail();
        Log::info('Country fetched:', ['country' => $country]);

        $resorts = $country->children()->where('type', 'resort')->get();
        Log::info('Resorts fetched:', ['resorts' => $resorts]);

        $categories = $this->getCategories();

        return inertia('Forums', [
            'category' => $resortsCategory,
            'continent' => $continent,
            'country' => $country,
            'resorts' => $resorts,
            'categories' => $categories,
        ]);
    }


}
