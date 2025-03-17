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


// ResortPage
Route::prefix('/forums/categories/resorts/{continentSlug}/{countrySlug}/{resortSlug}')->group(function () {

    // get data
    Route::get('/travel/posts', [ResortController::class, 'getTravelPosts'])->name('forums.categories.resorts.travelPosts');
    Route::get('/restaurants/posts', [ResortController::class, 'getRestaurantPosts'])->name('forums.categories.resorts.restaurantPosts');
    Route::get('/bars/posts', [ResortController::class, 'getBarPosts'])->name('forums.categories.resorts.barPosts');
    Route::get('/rentals/posts', [ResortController::class, 'getRentalsPosts'])->name('forums.categories.resorts.rentalsPosts');
    Route::get('/shops/posts', [ResortController::class, 'getShopsPosts'])->name('forums.categories.resorts.shopsPosts');
    Route::get('/events/posts', [ResortController::class, 'getEventsPosts'])->name('forums.categories.resorts.eventsPosts');
    Route::get('/news/posts', [ResortController::class, 'getNewsPosts'])->name('forums.categories.resorts.newsPosts');
    Route::get('/mountain/posts', [ResortController::class, 'getMountainPosts'])->name('forums.categories.resorts.mountainPosts');
    Route::get('/not-skiing/posts', [ResortController::class, 'getNotSkiingPosts'])->name('forums.categories.resorts.notskiingPosts');
    Route::get('/park/posts', [ResortController::class, 'getParkPosts'])->name('forums.categories.resorts.parkPosts');
    Route::get('/general/posts', [ResortController::class, 'getGeneralPosts'])->name('forums.categories.resorts.generalPosts');
    Route::get('/backcountry/posts', [ResortController::class, 'getBackcountryPosts'])->name('forums.categories.resorts.backcountryPosts');
    Route::get('/suggestions/posts', [ResortController::class, 'getSuggestionsPosts'])->name('forums.categories.resorts.suggestionsPosts');


    // show pages w/ data
    Route::get('/all', [ResortController::class, 'showAllPosts'])->name('forums.categories.resorts.allPosts');
    Route::get('/travel', [ResortController::class, 'showTravel'])->name('forums.categories.resorts.travel');
    Route::get('/restaurants', [ResortController::class, 'showRestaurant'])->name('forums.categories.resorts.restaurants');
});




// Post
Route::get('/forums/posts/{postId}', [PostController::class, 'single'])->name('posts');
Route::get('/forums/posts/users/{userId}', [PostController::class, 'userPosts'])->name('userPosts');
Route::get('/forums/comments/users/{userId}', [PostCommentController::class, 'userComments'])->name('userComments');
Route::get('/posts/{post}/comments', [PostCommentController::class, 'list'])->name('comments.list');






// auth crud post/comments
Route::middleware('auth')->group(function () {
    // Posts
    Route::get('/posts/create', [PostController::class, 'showCreatePost'])->name('showCreatePost');
    Route::post('/forums/newPost', [PostController::class, 'createPost'])->name('createPost');
    Route::put('/forums/posts/{postId}', [PostController::class, 'update'])->name('update');
    Route::delete('/forums/posts/{postId}', [PostController::class, 'delete'])->name('deletePost');

    // Comments
    Route::post('/posts/{post}/comments', [PostCommentController::class, 'create'])->name('comments.create');
    Route::put('/comments/{comment}', [PostCommentController::class, 'update'])->name('comments.update');
    Route::delete('/comments/{comment}', [PostCommentController::class, 'delete'])->name('comments.delete');
});








// Category navigation
Route::prefix('/forums/categories')->group(function () {
    // Resorts
    Route::prefix('/resorts')->group(function () {
        Route::get('/', [ResortsCategoryController::class, 'showResorts'])->name('forums.categories.resorts');
        Route::get('/{continentSlug}', [ResortsCategoryController::class, 'showContinent'])->name('forums.categories.resorts.continent');
        Route::get('/{continentSlug}/{countrySlug}', [ResortsCategoryController::class, 'showCountry'])->name('forums.categories.resorts.country');
        Route::get('/{continentSlug}/{countrySlug}/{resortSlug}', [ResortController::class, 'showResort'])->name('forums.categories.resortsPage');
    });

    // Events
    Route::prefix('/events')->group(function () {
        Route::get('/', [EventsCategoryController::class, 'showEvents'])->name('forums.categories.events');
        Route::get('/{subcategorySlug}', [EventsCategoryController::class, 'showSubcategory'])->name('forums.categories.events.subcategory');
    });

    // Gear
    Route::prefix('/gear')->group(function () {
        Route::get('/', [GearCategoryController::class, 'showGear'])->name('forums.categories.gear');
        Route::get('/{subcategorySlug}', [GearCategoryController::class, 'showSubcategory'])->name('forums.categories.gear.subcategory');
        Route::get('/{subcategorySlug}/{nestedSubcategorySlug}', [GearCategoryController::class, 'showNestedSubcategory'])->name('forums.categories.gear.nestedSubcategory');
    });

    // Technique
    Route::prefix('/technique')->group(function () {
        Route::get('/', [TechniqueCategoryController::class, 'showTechnique'])->name('forums.categories.technique');
        Route::get('/{subcategorySlug}', [TechniqueCategoryController::class, 'showSubcategory'])->name('forums.categories.technique.subcategory');
    });

    // Safety
    Route::prefix('/safety')->group(function () {
        Route::get('/', [SafetyCategoryController::class, 'showSafety'])->name('forums.categories.safety');
        Route::get('/{subcategorySlug}', [SafetyCategoryController::class, 'showSubcategory'])->name('forums.categories.safety.subcategory');
    });

    // Other
    Route::prefix('/other')->group(function () {
        Route::get('/', [OtherCategoryController::class, 'showOther'])->name('forums.categories.other');
        Route::get('/{subcategorySlug}', [OtherCategoryController::class, 'showSubcategory'])->name('forums.categories.other.subcategory');
    });

    // Generic category handler
    Route::get('/{categoryPath}', [CategoryListController::class, 'fullPath'])->name('forums.categories.fullPath');
    Route::get('/{category:slug}', [CategoryListController::class, 'show'])->name('forums.categories.show');
});
