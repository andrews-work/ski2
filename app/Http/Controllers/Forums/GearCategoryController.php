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
            'posts' => null,
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

        $nestedSubcategories = $subcategory->children;
        $posts = $nestedSubcategories->isEmpty() ? $subcategory->posts : null;

        return Inertia::render('Forums', [
            'category' => $subcategory,
            'subcategories' => $nestedSubcategories,
            'posts' => $posts,
        ]);
    }

    public function showNestedSubcategory($subcategorySlug, $nestedSubcategorySlug)
    {
        Log::info('GearCategoryController - showNestedSubcategory called', [
            'subcategorySlug' => $subcategorySlug,
            'nestedSubcategorySlug' => $nestedSubcategorySlug,
        ]);

        $category = CategoryListModel::where('slug', 'gear')->firstOrFail();
        Log::info('Gear category fetched:', ['category' => $category]);

        $subcategory = $category->children()->where('slug', $subcategorySlug)->firstOrFail();
        Log::info('Subcategory fetched:', ['subcategory' => $subcategory]);

        $nestedSubcategory = $subcategory->children()->where('slug', $nestedSubcategorySlug)->firstOrFail();
        Log::info('Nested subcategory fetched:', ['nestedSubcategory' => $nestedSubcategory]);

        $posts = $nestedSubcategory->posts;
        Log::info('Posts fetched:', ['posts' => $posts]);

        return Inertia::render('Forums', [
            'category' => $nestedSubcategory,
            'subcategories' => null,
            'posts' => $posts,
        ]);
    }
}
