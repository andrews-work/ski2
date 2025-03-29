<?php

use App\Http\Controllers\Resort\CategoriesController;
use App\Http\Controllers\ResortsController;
use Illuminate\Support\Facades\Route;

Route::get('/resorts/continents', [ResortsController::class, 'continents'])->name('resorts.continents');
