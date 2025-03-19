<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Marketplace\MarketplaceController;

Route::get('/marketplace/sell', [MarketplaceController::class, 'sell'])->name('marketplace.sell');
Route::get('/marketplace/wishlist', [MarketplaceController::class, 'wishlist'])->name('marketplace.wishlist');

Route::post('/marketplace/sell/listItem', [MarketplaceController::class, 'listItem'])->name('marketplace.listItem');