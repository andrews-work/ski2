<?php

namespace App\Http\Controllers\Forums;

use App\Http\Controllers\Controller;
use App\Models\Forums\CategoryListModel;
use App\Models\Forums\PostModel;
use Inertia\Inertia;
use Illuminate\Support\Facades\Log;

class ForumsController extends Controller
{
    public function index()
{
    Log::info('ForumsController - called');

    $categories = CategoryListModel::whereNull('parent_id')->get();
    $subcategories = CategoryListModel::whereNotNull('parent_id')->get();
    $continents = CategoryListModel::where('type', 'continent')->get();
    $countries = CategoryListModel::where('type', 'country')->get();
    $resorts = CategoryListModel::where('type', 'resort')->get();

    $posts = PostModel::with(['user', 'category'])
        ->orderBy('created_at', 'desc')
        ->take(10)
        ->get();
    Log::info('Forums Page - posts:'. $posts->count());

    Log::info('Forums Page - Categories: ' . $categories->count());
    Log::info('Forums Page - Subcategories: ' . $subcategories->count());
    // Log::info('Categories Data:', $categories->toArray());
    // Log::info('Subcategories Data:', $subcategories->toArray());

    return Inertia::render('Forums', [
        'categories' => $categories,
        'subcategories' => $subcategories,
        'continents' => $continents,
        'countries' => $countries,
        'resorts' => $resorts,
        'posts' => $posts,
        'category' => null,
        'subcategory' => null,
        'continent' => null,
        'country' => null,
        'resort' => null,
        'post' => null,
        'userPost' => null,
        'createPost' => null,
    ]);
}

}
