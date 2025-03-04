<?php

use App\Http\Controllers\Forums\ForumsController;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;
use App\Http\Controllers\Forums\CategoryListController;

Route::get('/', function () {
    return Inertia::render('Welcome');
})->name('home');

// forums
Route::get('/forums', [ForumsController::class, 'index'])->name('forums');
Route::get('/auths/forums', [ForumsController::class, 'index'])->middleware(['auth', 'verified'])->name('auths.forums');
// Route::get('forums/categories/{category:slug}', [CategoryListController::class, 'all'])->name('forums.categories');
Route::get('forums/categories/{category:slug}', [CategoryListController::class, 'show'])->name('forums.categories.show');


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
