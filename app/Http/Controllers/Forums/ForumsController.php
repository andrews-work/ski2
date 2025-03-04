<?php

namespace App\Http\Controllers\Forums;

use App\Http\Controllers\Controller;
use App\Models\Forums\CategoryListModel;
use Inertia\Inertia;
use Illuminate\Support\Facades\Log;

class ForumsController extends Controller
{
    public function index()
    {
        Log::info('ForumsController - called');

        $categories = CategoryListModel::whereNull('parent_id')->get();
        $subcategories = CategoryListModel::whereNotNull('parent_id')->get();

        Log::info('Forums Page - rendering with ' . $categories->count() . ' categories and ' . $subcategories->count() . ' subcategories');

        return Inertia::render('Forums', [
            'categories' => $categories,
            'subcategories' => $subcategories,
        ]);
    }
}
