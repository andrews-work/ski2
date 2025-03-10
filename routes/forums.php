<?php

use App\Http\Controllers\Forums\ForumsController;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;
use App\Http\Controllers\Forums\CategoryListController;
use App\Http\Controllers\Forums\ResortsCategoryController;
use App\Http\Controllers\Forums\PostController;
use App\Http\Controllers\Forums\PostCommentController;

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

// Forum categories
Route::get('/forums', [ForumsController::class, 'index'])->name('forums');
Route::prefix('/forums/categories/resorts')->group(function () {
    Route::get('/', [ResortsCategoryController::class, 'showResorts'])->name('forums.categories.resorts');
    Route::get('/{continentSlug}', [ResortsCategoryController::class, 'showContinent'])->name('forums.categories.resorts.continent');
    Route::get('/{continentSlug}/{countrySlug}', [ResortsCategoryController::class, 'showCountry'])->name('forums.categories.resorts.country');
    Route::get('/{continentSlug}/{countrySlug}/{resortSlug}', [ResortsCategoryController::class, 'showResort'])->name('forums.categories.resortsPage');
});
Route::get('/forums/categories/{category:slug}', [CategoryListController::class, 'show'])->name('forums.categories.show');
