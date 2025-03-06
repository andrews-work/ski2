<?php

use App\Http\Controllers\Forums\ForumsController;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;
use App\Http\Controllers\Forums\CategoryListController;
use App\Http\Controllers\Forums\ResortsCategoryController;
use App\Http\Controllers\Forums\PostController;

Route::get('/', function () {
    return Inertia::render('Welcome');
})->name('home');

// posts
Route::get('/posts/{postId}', [PostController::class, 'single'])->name('posts.single');
route::get('/posts/{userId', [PostController::class, 'user-posts'])->name('posts.user');

// forums
Route::get('/forums', [ForumsController::class, 'index'])->name('forums');
Route::prefix('/forums/categories/resorts')->group(function () {
    Route::get('/', [ResortsCategoryController::class, 'showResorts'])->name('forums.categories.resorts');
    Route::get('/{continentSlug}', [ResortsCategoryController::class, 'showContinent'])->name('forums.categories.resorts.continent');
    Route::get('/{continentSlug}/{countrySlug}', [ResortsCategoryController::class, 'showCountry'])->name('forums.categories.resorts.country');
    Route::get('/{continentSlug}/{countrySlug}/{resortSlug}', [ResortsCategoryController::class, 'showResort'])->name('forums.categories.resortsPage');
});
Route::get('/forums/categories/{category:slug}', [CategoryListController::class, 'show'])->name('forums.categories.show');

Route::get('/resorts', function () {
    return Inertia::render('Resorts');
})->name('resorts');

Route::get('/auths/resorts', function () {
    return Inertia::render('Resorts');
})->middleware(['auth', 'verified'])->name('auths.resorts');

Route::get('/marketplace', function () {
    return Inertia::render('Marketplace');
})->name('marketplace');

Route::get('/auths/marketplace', function () {
    return Inertia::render('Marketplace');
})->middleware(['auth', 'verified'])->name('auths.marketplace');

Route::get('dashboard', function () {
    return Inertia::render('auths/Dashboard');
})->middleware(['auth', 'verified'])->name('auths.dashboard');

require __DIR__.'/settings.php';
require __DIR__.'/auth.php';
