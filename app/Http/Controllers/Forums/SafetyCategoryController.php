<?php

namespace App\Http\Controllers\Forums;

use Inertia\Inertia;
use App\Models\Forums\CategoryListModel;
use Illuminate\Support\Facades\Log;

class SafetyCategoryController
{
    public function showSafety()
    {
        Log::info('SafetyCategoryController - showSafety called');

        $category = CategoryListModel::where('slug', 'safety')->firstOrFail();
        Log::info('Safety category fetched:', ['category' => $category]);

        $subcategories = $category->children;
        Log::info('Subcategories fetched:', ['subcategories' => $subcategories]);

        return Inertia::render('Forums', [
            'category' => $category,
            'subcategories' => $subcategories,
        ]);
    }

    public function showSubcategory($subcategorySlug)
    {
        Log::info('SafetyCategoryController - showSubcategory called', [
            'subcategorySlug' => $subcategorySlug,
        ]);

        $category = CategoryListModel::where('slug', 'safety')->firstOrFail();
        Log::info('Safety category fetched:', ['category' => $category]);

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
