<?php

use App\Http\Controllers\Forums\ResortController;
use App\Http\Controllers\Resort\CategoriesController;
use App\Http\Controllers\Resort\InfoController;
use App\Http\Controllers\Resort\TownCategoriesController;
use App\Http\Controllers\ResortsController;
use Illuminate\Support\Facades\Route;

Route::get('/resorts/continents', [ResortsController::class, 'continents'])->name('resorts.continents');
Route::get('/resorts/{continentSlug}', [ResortsController::class, 'countries'])->name('resorts.countries'); // shows list of countries
Route::get('/resorts/{continentSlug}/{countrySlug}', [ResortsController::class, 'states'])->name('resorts.states'); // shows list of states
Route::get('/resorts/{continentSlug}/{countrySlug}/{stateSlug}', [ResortsController::class, 'towns'])->name('resorts.towns'); // shows list of towns

// town / resort / mountain
Route::get('/resorts/{continentSlug}/{countrySlug}/{stateSlug}/{townSlug}', [ResortsController::class, 'town'])->name('resorts.town'); // town Page

// town categories
// town categories
Route::prefix('/resorts/{continentSlug}/{countrySlug}/{stateSlug}/{townSlug}')->name('town.')->group(function () {
    Route::get('/general', [TownCategoriesController::class, 'general'])->name('general');
    Route::get('/events', [TownCategoriesController::class, 'events'])->name('events');
    Route::get('/weather', [TownCategoriesController::class, 'weather'])->name('weather');
    Route::get('/resorts', [TownCategoriesController::class, 'resort'])->name('resort');
    Route::get('/backcountry', [TownCategoriesController::class, 'backcountry'])->name('backcountry');
    Route::get('/forums', [TownCategoriesController::class, 'forums'])->name('forums');
    Route::get('/arts', [TownCategoriesController::class, 'arts'])->name('arts');
    Route::get('/activities', [TownCategoriesController::class, 'activities'])->name('activities');
    Route::get('/accomodation', [TownCategoriesController::class, 'accomodation'])->name('accomodation');
    Route::get('/food-drink', [TownCategoriesController::class, 'food'])->name('food');
    Route::get('/transport', [TownCategoriesController::class, 'transport'])->name('transport');
    Route::get('/jobs', [TownCategoriesController::class, 'jobs'])->name('jobs');
    Route::get('/marketplace', [TownCategoriesController::class, 'marketplace'])->name('marketplace');
    Route::get('/companies', [TownCategoriesController::class, 'companies'])->name('companies');
    Route::get('/fitness', [TownCategoriesController::class, 'fitness'])->name('fitness');
    Route::get('/content', [TownCategoriesController::class, 'content'])->name('content');
    Route::get('/atm', [TownCategoriesController::class, 'atm'])->name('atm');
    Route::get('/maps', [TownCategoriesController::class, 'maps'])->name('maps');
    Route::get('/rentals', [TownCategoriesController::class, 'rentals'])->name('rentals');
});

// resort categories
Route::get('/resorts/{continentSlug}/{countrySlug}/{stateSlug}/{townSlug}/{resortSlug}', [ResortsController::class, 'resort'])->name('resorts.resort'); // resort page
Route::get('/resorts/{continentSlug}/{countrySlug}/{stateSlug}/{townSlug}/{resortSlug}/{mountainSlug}', [ResortsController::class, 'mountain'])->name('resorts.mountain');


// mountain categories

// Route::get('/resorts/{continentSlug}/{countrySlug}/{stateSlug}', [ResortsController::class, 'resortTowns'])->name('resorts.resortTowns');
// Route::get('/resorts/{continentSlug}/{countrySlug}/{stateSlug}/{townSlug}', [ResortsController::class, 'towns'])->name('resorts.towns');
// Route::get('/resorts/{continentSlug}/{countrySlug}/{stateSlug}/{townSlug}/{resortSlug}', [ResortsController::class, 'resort'])->name('resorts.resort');


// Route::get('/resorts/{continentSlug}/{countrySlug}/{resortSlug}/info', [CategoriesController::class, 'info'])->name('resorts.info');
// Route::get('/resorts/{continentSlug}/{countrySlug}/{resortSlug}/hotels', [CategoriesController::class, 'hotels'])->name('resorts.hotels');
// Route::get('/resorts/{continentSlug}/{countrySlug}/{resortSlug}/restaurants', [CategoriesController::class, 'restaurants'])->name('resorts.restaurants');
// Route::get('/resorts/{continentSlug}/{countrySlug}/{resortSlug}/forums', [CategoriesController::class, 'forums'])->name('resorts.forums');
// Route::get('/resorts/{continentSlug}/{countrySlug}/{resortSlug}/bars', [CategoriesController::class, 'bars'])->name('resorts.bars');
// Route::get('/resorts/{continentSlug}/{countrySlug}/{resortSlug}/events', [CategoriesController::class, 'events'])->name('resorts.events');
// Route::get('/resorts/{continentSlug}/{countrySlug}/{resortSlug}/jobs', [CategoriesController::class, 'jobs'])->name('resorts.jobs');
// Route::get('/resorts/{continentSlug}/{countrySlug}/{resortSlug}/marketplace', [CategoriesController::class, 'marketplace'])->name('resorts.marketplace');
// Route::get('/resorts/{continentSlug}/{countrySlug}/{resortSlug}/companies', [CategoriesController::class, 'companies'])->name('resorts.companies');
// Route::get('/resorts/{continentSlug}/{countrySlug}/{resortSlug}/weather', [CategoriesController::class, 'weather'])->name('resorts.weather');

// Route::get('/resorts/{continentSlug}/{countrySlug}/{resortSlug}/info/update', [InfoController::class, 'updateMinute'])->name('resorts.info.updateMinute');
