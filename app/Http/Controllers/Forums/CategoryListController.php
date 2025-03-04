<?php

namespace App\Http\Controllers\Forums;

use App\Http\Controllers\Controller;
use App\Models\Forums\CategoryListModel;
use Illuminate\Support\Facades\Log;

class CategoryListController extends Controller
{
    public function show($slug)
    {
        Log::info('CategoryListController - show category: ' . $slug);

        $category = CategoryListModel::where('slug', $slug)->firstOrFail();
        $subcategories = $this->getSubcategories($category->id);
        $categories = $this->getCategories();

        Log::info('Category fetched: ' . $category->name);
        Log::info('Subcategories fetched: ' . $subcategories->count());

        return inertia('Forums', [
            'category' => $category,
            'categories' => $categories,
            'subcategories' => $subcategories,
        ]);
    }

    public function showSubCategory($categorySlug, $subcategorySlug)
    {
        $category = CategoryListModel::where('slug', $categorySlug)->firstOrFail();
        $subcategory = CategoryListModel::where('slug', $subcategorySlug)
            ->where('parent_id', $category->id)
            ->firstOrFail();
        $subsubcategories = $this->getSubcategories($subcategory->id);
        $categories = $this->getCategories();

        return inertia('Forums', [
            'category' => $category,
            'subcategory' => $subcategory,
            'subsubcategories' => $subsubcategories,
            'categories' => $categories,
        ]);
    }

    protected function getCategories()
    {
        Log::info('CategoryListController - getCategories');
        return CategoryListModel::whereNull('parent_id')->get();
    }

    protected function getSubcategories($parentId)
    {
        Log::info('CategoryListController - getSubcategories for parent_id: ' . $parentId);
        return CategoryListModel::where('parent_id', $parentId)->get();
    }
}
