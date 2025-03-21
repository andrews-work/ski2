<?php

use App\Http\Controllers\Forums\ResortController;
use Illuminate\Support\Facades\Route;

// Route::get('/marketplace/listings/{CateogyrId}', [MarketplaceController::class, 'showListingCategory'])->name('marketplace.showListingCategory');

Route::get('/resorts/{continents)', [ResortController::class, 'listContinents'])->name('resorts.world');
Route::get('/resorts/{continentId)', [ResortController::class, 'listCountries'])->name('resorts.continent');
Route::get('/resorts/{continentId}/{countryId)', [ResortController::class, 'listResorts'])->name('resorts.country');
Route::get('/resorts/{continentId}/{countryId}/{resortId}', [ResortController::class, 'showResort'])->name('resorts.resort');