<?php

namespace App\Http\Controllers\Forums;

use Inertia\Inertia;
use App\Models\Forums\CategoryListModel;
use Illuminate\Support\Facades\Log;

class GearCategoryController
{
    public function showGear()
    {
        Log::info('GearCategoryController - showGear called');

        $category = CategoryListModel::where('slug', 'gear')->firstOrFail();
        Log::info('Gear category fetched:', ['category' => $category]);

        $subcategories = $category->children;
        Log::info('Subcategories fetched:', ['subcategories' => $subcategories]);

        return Inertia::render('Forums', [
            'category' => $category,
            'subcategories' => $subcategories,
        ]);
    }

    public function showSubcategory($subcategorySlug)
    {
        Log::info('GearCategoryController - showSubcategory called', [
            'subcategorySlug' => $subcategorySlug,
        ]);

        $category = CategoryListModel::where('slug', 'gear')->firstOrFail();
        Log::info('Gear category fetched:', ['category' => $category]);

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
