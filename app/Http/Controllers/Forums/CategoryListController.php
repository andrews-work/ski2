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
}
