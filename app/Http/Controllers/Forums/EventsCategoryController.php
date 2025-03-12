<?php

namespace App\Http\Controllers\Forums;

use Inertia\Inertia;
use App\Models\Forums\CategoryListModel;
use Illuminate\Support\Facades\Log;

class EventsCategoryController
{
    public function showEvents()
    {
        Log::info('EventsCategoryController - showEvents called');

        $category = CategoryListModel::where('slug', 'events')->firstOrFail();
        Log::info('Events category fetched:', ['category' => $category]);

        $subcategories = $category->children;
        Log::info('Subcategories fetched:', ['subcategories' => $subcategories]);

        return Inertia::render('Forums', [
            'category' => $category,
            'subcategories' => $subcategories,
        ]);
    }

    public function showSubcategory($subcategorySlug)
    {
        Log::info('EventsCategoryController - showSubcategory called', [
            'subcategorySlug' => $subcategorySlug,
        ]);

        $category = CategoryListModel::where('slug', 'events')->firstOrFail();
        Log::info('Events category fetched:', ['category' => $category]);

        $subcategory = $category->children()->where('slug', $subcategorySlug)->firstOrFail();
        Log::info('Subcategory fetched:', ['subcategory' => $subcategory]);

        $posts = $subcategory->posts;
        Log::info('Posts fetched:', ['posts' => $posts]);

        return Inertia::render('Forums', [
            'category' => $subcategory,
            'subcategory' => $subcategory,
            'posts' => $posts,
        ]);
    }
}
