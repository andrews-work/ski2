<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Forums\ForumsController;
use App\Http\Controllers\Marketplace\MarketplaceController;
use App\Http\Controllers\MatesController;
use App\Http\Controllers\ResortsController;
use Inertia\Inertia;

Route::get('/', function () {
    return Inertia::render('Welcome');
})->name('home');

Route::get('/resorts', function () {
    return Inertia::render('Resorts');
})->name('resorts');

Route::get('/forums', [ForumsController::class, 'index'])->name('forums');
Route::get('/marketplace', [MarketplaceController::class, 'index'])->name('marketplace');
Route::get('/mates', [MatesController::class, 'index'])->name('mates');
Route::get('/resorts', [ResortsController::class, 'index'])->name('resorts');

Route::get('/casino', function () {
    return Inertia::render('Casino');
})->name('casino');





Route::get('dashboard', function () {
    return Inertia::render('auths/Dashboard');
})->middleware(['auth', 'verified'])->name('auths.dashboard');




Route::get('/auths/resorts', function () {
    return Inertia::render('Resorts');
})->middleware(['auth', 'verified'])->name('auths.resorts');





require __DIR__. '/settings.php';
require __DIR__. '/auth.php';
require __DIR__. '/forums.php';
require __DIR__. '/channels.php';
require __DIR__. '/marketplace.php';
require __DIR__. '/resorts.php';