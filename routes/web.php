<?php

use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

Route::get('/', function () {
    return Inertia::render('Welcome');
})->name('home');

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
require __DIR__.'/forums.php';
