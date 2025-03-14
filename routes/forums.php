<?php

use App\Http\Controllers\Forums\ForumsController;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;
use App\Http\Controllers\Forums\CategoryListController;
use App\Http\Controllers\Forums\ResortsCategoryController;
use App\Http\Controllers\Forums\EventsCategoryController;
use App\Http\Controllers\Forums\PostController;
use App\Http\Controllers\Forums\PostCommentController;
use App\Http\Controllers\Forums\GearCategoryController;
use App\Http\Controllers\Forums\TechniqueCategoryController;
use App\Http\Controllers\Forums\OtherCategoryController;
use App\Http\Controllers\Forums\SafetyCategoryController;
use App\Http\Controllers\Forums\ResortController;

// Forum categories
Route::get('/forums', [ForumsController::class, 'index'])->name('forums');

// Posts
Route::middleware('auth')->group(function () {
    Route::delete('/forums/posts/{postId}', [PostController::class, 'delete'])->name('deletePost');
    Route::put('/forums/posts/{postId}', [PostController::class, 'update'])->name('update');
    Route::get('/posts/create', [PostController::class, 'showCreatePost'])->name('showCreatePost');
    Route::post('/forums/newPost', [PostController::class, 'createPost'])->name('createPost');
});

Route::get('/forums/posts/{postId}', [PostController::class, 'single'])->name('posts');
Route::get('/forums/posts/users/{userId}', [PostController::class, 'userPosts'])->name('userPosts');
Route::get('/forums/comments/users/{userId}', [PostCommentController::class, 'userComments'])->name('userComments');

// Comments
Route::middleware('auth')->group(function () {
    Route::post('/posts/{post}/comments', [PostCommentController::class, 'create'])->name('comments.create');
    Route::put('/comments/{comment}', [PostCommentController::class, 'update'])->name('comments.update');
    Route::delete('/comments/{comment}', [PostCommentController::class, 'delete'])->name('comments.delete');
});

Route::get('/posts/{post}/comments', [PostCommentController::class, 'list'])->name('comments.list');

// Resorts category
Route::prefix('/forums/categories/resorts')->group(function () {

    // routes to get to a resort
    Route::get('/', [ResortsCategoryController::class, 'showResorts'])->name('forums.categories.resorts');
    Route::get('/{continentSlug}', [ResortsCategoryController::class, 'showContinent'])->name('forums.categories.resorts.continent');
    Route::get('/{continentSlug}/{countrySlug}', [ResortsCategoryController::class, 'showCountry'])->name('forums.categories.resorts.country');
    Route::get('/{continentSlug}/{countrySlug}/{resortSlug}', [ResortController::class, 'showResort'])->name('forums.categories.resortsPage');
});

// routes for a resort
Route::get('/forums/categories/resorts/{resortId}/topics/{topicId?}', [ResortController::class, 'getPostsByResortAndTopic']);
Route::get('/forums/categories/resorts/{continentSlug}/{countrySlug}/{resortSlug}/all', [ResortController::class, 'showAllPosts'])->name('forums.categories.resorts.allPosts');

// Events category
Route::prefix('/forums/categories/events')->group(function () {
    Route::get('/', [EventsCategoryController::class, 'showEvents'])->name('forums.categories.events');
    Route::get('/{subcategorySlug}', [EventsCategoryController::class, 'showSubcategory'])->name('forums.categories.events.subcategory');
});

// Gear category
Route::prefix('/forums/categories/gear')->group(function () {
    Route::get('/', [GearCategoryController::class, 'showGear'])->name('forums.categories.gear');
    Route::get('/{subcategorySlug}', [GearCategoryController::class, 'showSubcategory'])->name('forums.categories.gear.subcategory');
    Route::get('/{subcategorySlug}/{nestedSubcategorySlug}', [GearCategoryController::class, 'showNestedSubcategory'])->name('forums.categories.gear.nestedSubcategory');
});

// Technique category
Route::prefix('/forums/categories/technique')->group(function () {
    Route::get('/', [TechniqueCategoryController::class, 'showTechnique'])->name('forums.categories.technique');
    Route::get('/{subcategorySlug}', [TechniqueCategoryController::class, 'showSubcategory'])->name('forums.categories.technique.subcategory');
});

// Safety category
Route::prefix('/forums/categories/safety')->group(function () {
    Route::get('/', [SafetyCategoryController::class, 'showSafety'])->name('forums.categories.safety');
    Route::get('/{subcategorySlug}', [SafetyCategoryController::class, 'showSubcategory'])->name('forums.categories.safety.subcategory');
});

// Other category
Route::prefix('/forums/categories/other')->group(function () {
    Route::get('/', [OtherCategoryController::class, 'showOther'])->name('forums.categories.other');
    Route::get('/{subcategorySlug}', [OtherCategoryController::class, 'showSubcategory'])->name('forums.categories.other.subcategory');
});

// Generic category handler
Route::get('/forums/categories/{categoryPath}', [CategoryListController::class, 'fullPath'])->name('forums.categories.fullPath');
Route::get('/forums/categories/{category:slug}', [CategoryListController::class, 'show'])->name('forums.categories.show');
