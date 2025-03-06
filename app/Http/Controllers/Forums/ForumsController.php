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

        $posts = PostModel::with(['user', 'category'])
            ->orderBy('created_at', 'desc')
            ->take(10)
            ->get();

        Log::info('Forums Page - rendering with ' . $categories->count() . ' categories, ' . $subcategories->count() . ' subcategories, and ' . $posts->count() . ' posts');

        return Inertia::render('Forums', [
            'categories' => $categories,
            'subcategories' => $subcategories,
            'posts' => $posts,
        ]);
    }
}
