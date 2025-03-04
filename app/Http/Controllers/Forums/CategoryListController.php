<?php

namespace App\Http\Controllers\Forums;

use App\Http\Controllers\Controller;
use App\Models\Forums\CategoryListModel;
use Illuminate\Support\Facades\Log;

class CategoryListController extends Controller
{
    // Get all categories and subcategories
    public function all()
    {
        Log::info('CategoryListController - all');

        $categories = $this->categories();
        Log::info('Categories fetched: ' . count($categories));

        $subcategories = $this->subcategories();
        Log::info('Subcategories fetched: ' . count($subcategories));

        return inertia('Forums', [
            'categories' => $categories,
            'subcategories' => $subcategories,
        ]);
    }

    public function show($slug)
    {
        Log::info('CategoryListController - show category: ' . $slug);

        $category = CategoryListModel::where('slug', $slug)->firstOrFail();
        $subcategories = CategoryListModel::where('parent_id', $category->id)->get();

        Log::info('Category fetched: ' . $category->name);
        Log::info('Subcategories fetched: ' . $subcategories->count());

        return inertia('CategoryPage', [
            'category' => $category,
            'subcategories' => $subcategories,
        ]);
    }

    // Get categories (top-level)
    public function categories()
    {
        Log::info('CategoryListController - categories');

        $categories = CategoryListModel::whereNull('parent_id')->get();
        Log::info('Categories fetched: ' . $categories->count());

        return $categories;
    }

    // Get subcategories (child categories)
    public function subcategories()
    {
        Log::info('CategoryListController - subcategories');

        $subcategories = CategoryListModel::whereNotNull('parent_id')->get();
        Log::info('Subcategories fetched: ' . $subcategories->count());

        return $subcategories;
    }
}
