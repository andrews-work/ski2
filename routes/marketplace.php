<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Marketplace\MarketplaceController;

// pages
Route::get('/marketplace/sell', [MarketplaceController::class, 'sell'])->name('marketplace.sell');
Route::get('/marketplace/wishlist', [MarketplaceController::class, 'wishlist'])->name('marketplace.wishlist');
Route::get('/marketplace/listings', [MarketplaceController::class, 'listings'])->name('marketplace.listings');
Route::get('/marketplace/listings/mine', [MarketplaceController::class, 'myListings'])->name('marketplace.myListings');

// crud
Route::post('/marketplace/sell/listItem', [MarketplaceController::class, 'createListing'])->name('marketplace.createListing');
Route::get('/marketplace/categories', [MarketplaceController::class, 'getCategories'])->name('marketplace.categories');


Route::get('/marketplace/listings/{listingId}', [MarketplaceController::class, 'showListing'])->name('marketplace.showListing');
Route::get('/marketplace/listings/{CateogyrId}', [MarketplaceController::class, 'showListingCategory'])->name('marketplace.showListingCategory');


