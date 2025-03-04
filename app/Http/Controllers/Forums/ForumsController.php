<?php

namespace App\Http\Controllers\Forums;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Controllers\Forums\CategoryListController;
use Inertia\Inertia;
use Illuminate\Support\Facades\Log;

class ForumsController extends Controller
{
    protected $categoryListController;

    // DI categories
    public function __construct(CategoryListController $categoryListController)
    {
        $this->categoryListController = $categoryListController;
    }

    // get categories
    public function index()
    {
        Log::info('ForumsController - called');

        $categories = $this->categoryListController->categories();
        $subcategories = $this->categoryListController->subcategories();

        Log::info('Forums Page - rendering with ' . count($categories) . ' categories and ' . count($subcategories) . ' subcategories');

        return Inertia::render('Forums', [
            'categories' => $categories,
            'subcategories' => $subcategories,
        ]);
    }
}
