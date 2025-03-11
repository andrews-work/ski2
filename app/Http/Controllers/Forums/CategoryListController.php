<?php

namespace App\Http\Controllers\Forums;

use App\Http\Controllers\Controller;
use App\Models\Forums\CategoryListModel;
use Illuminate\Support\Facades\Log;
use Inertia\Inertia;

class CategoryListController extends Controller
{
    public function show($slug)
    {
        Log::info('CategoryListController - show category: ' . $slug);

        $category = CategoryListModel::where('slug', $slug)
            ->with('children.children.children')
            ->firstOrFail();
        Log::info('Category fetched: ' . $category->name);

        $categories = $this->getCategories();
        Log::info('Subcategories fetched: ' . $category->children->count());

        return inertia('Forums', [
            'category' => $category,
            'categories' => $categories,
            'subcategories' => $category->children,
        ]);
    }

    protected function getCategories()
    {
        Log::info('CategoryListController - getCategories');
        return CategoryListModel::whereNull('parent_id')->get();
    }

    public function fullPath($categoryPath)
    {
        Log::info('category: ' . $categoryPath);

        $category = CategoryListModel::where('slug', $categoryPath)->first();

        if (!$category) {
            Log::error('Category not found: ' . $categoryPath);
            return response()->json(['error' => 'Category not found'], 404);
        }

        // Get the full path for the category
        $fullPath = $this->getFullPath($category);

        Log::info('Full path for category: ' . $fullPath);

        return Inertia::location($fullPath);
    }

    public function getFullPath($category, $path = '')
    {
        // Prepend the current category's slug to the path
        $path = $category->slug . ($path ? '/' . $path : '');

        // If the category has a parent, recursively build the path
        if ($category->parent) {
            return $this->getFullPath($category->parent, $path);
        }

        // Return the full path with the /forums/categories prefix
        return '/forums/categories/' . $path;
    }
}
