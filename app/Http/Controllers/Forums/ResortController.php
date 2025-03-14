<?php

namespace App\Http\Controllers\Forums;

use App\Http\Controllers\Controller;
use App\Models\Forums\CategoryListModel;
use App\Models\Forums\PostModel;
use App\Models\Forums\TopicModel;
use Illuminate\Support\Facades\Log;
use Inertia\Inertia;

class ResortController extends Controller
{
    protected function getCategories()
    {
        Log::info('ResortsCategoryController - getCategories');
        return CategoryListModel::whereNull('parent_id')->get();
    }

    public function showResort($continentSlug, $countrySlug, $resortSlug)
    {
        Log::info('ResortsCategoryController - showResort called', [
            'continentSlug' => $continentSlug,
            'countrySlug' => $countrySlug,
            'resortSlug' => $resortSlug,
        ]);

        $resortsCategory = CategoryListModel::where('slug', 'resorts')->firstOrFail();
        Log::info('Resorts category fetched:', ['resortsCategory' => $resortsCategory]);

        $continent = CategoryListModel::where('slug', $continentSlug)
            ->where('parent_id', $resortsCategory->id)
            ->where('type', 'continent')
            ->firstOrFail();
        Log::info('Continent fetched:', ['continent' => $continent]);

        $country = CategoryListModel::where('slug', $countrySlug)
            ->where('parent_id', $continent->id)
            ->where('type', 'country')
            ->firstOrFail();
        Log::info('Country fetched:', ['country' => $country]);

        $resort = CategoryListModel::where('slug', $resortSlug)
            ->where('parent_id', $country->id)
            ->where('type', 'resort')
            ->firstOrFail();
        Log::info('Resort fetched:', ['resort' => $resort]);

        $posts = PostModel::with('user')
            ->where('category_id', $resort->id)
            ->orderBy('created_at', 'desc')
            ->get();

        Log::info('Posts fetched for resort:', ['posts' => $posts]);

        $categories = $this->getCategories();

        return inertia('Forums', [
            'category' => $resortsCategory,
            'continent' => $continent,
            'country' => $country,
            'resort' => $resort,
            'posts' => $posts,
            'categories' => $categories,
            'continentSlug' => $continentSlug,
            'countrySlug' => $countrySlug,
            'resortSlug' => $resortSlug,
        ]);
    }

    public function getPostsByResortAndTopic($resortId, $topicId = null)
    {
        Log::info('Entering getPostsByResortAndTopic method', ['resortId' => $resortId, 'topicId' => $topicId]);

        $posts = PostModel::where('category_id', $resortId);

        if ($topicId) {
            $posts->where('topic_id', $topicId);
        }

        Log::info('Fetching posts from PostModel with query', [
            'resortId' => $resortId,
            'topicId' => $topicId,
        ]);

        $posts = $posts->orderBy('created_at', 'desc')
                       ->with('user')
                       ->get();

        Log::info('Fetched posts successfully', ['postCount' => $posts->count()]);

        try {
            $resort = CategoryListModel::findOrFail($resortId);
            Log::info('Resort fetched successfully', ['resortId' => $resortId]);
        } catch (\Exception $e) {
            Log::error('Resort not found', ['resortId' => $resortId, 'error' => $e->getMessage()]);
            throw $e;
        }

        $topic = null;
        if ($topicId) {
            $topic = TopicModel::find($topicId);
            if ($topic) {
                Log::info('Topic fetched successfully', ['topicId' => $topicId]);
            } else {
                Log::warning('Topic not found', ['topicId' => $topicId]);
            }
        }

        Log::info('Rendering view with data', [
            'resort' => $resort->name,
            'topic' => $topic ? $topic->name : 'None',
            'postCount' => $posts->count(),
        ]);

        return Inertia::render('Forums', [
            'resort' => $resort,
            'topic' => $topic,
            'posts' => $posts,
        ]);
    }

    public function showCategoryPosts($categoryId)
    {
        Log::info('ResortController - showCategoryPosts called', [
            'categoryId' => $categoryId,
        ]);

        $category = CategoryListModel::findOrFail($categoryId);
        Log::info('Category fetched:', ['category' => $category]);

        $posts = PostModel::with('user')
            ->where('category_id', $category->id)
            ->orderBy('created_at', 'desc')
            ->get();

        Log::info('Posts fetched for category:', ['posts' => $posts]);

        return inertia('Forums', [
            'category' => $category,
            'posts' => $posts,
        ]);
    }

    public function showAllPosts($continentSlug, $countrySlug, $resortSlug)
    {
        Log::info('ResortsCategoryController - showAllPosts called', [
            'continentSlug' => $continentSlug,
            'countrySlug' => $countrySlug,
            'resortSlug' => $resortSlug,
        ]);

        $resortsCategory = CategoryListModel::where('slug', 'resorts')->firstOrFail();
        Log::info('Resorts category fetched:', ['resortsCategory' => $resortsCategory]);

        $continent = CategoryListModel::where('slug', $continentSlug)
            ->where('parent_id', $resortsCategory->id)
            ->where('type', 'continent')
            ->firstOrFail();

        $country = CategoryListModel::where('slug', $countrySlug)
            ->where('parent_id', $continent->id)
            ->where('type', 'country')
            ->firstOrFail();

        $resort = CategoryListModel::where('slug', $resortSlug)
            ->where('parent_id', $country->id)
            ->where('type', 'resort')
            ->firstOrFail();

        $posts = PostModel::with('user')
            ->where('category_id', $resort->id)
            ->orderBy('created_at', 'desc')
            ->get();
        Log::info('Posts fetched for resort:', ['posts' => $posts]);

        return inertia('Forums', [
            'category' => $resort,
            'posts' => $posts,
            'continentSlug' => $continentSlug,
            'countrySlug' => $countrySlug,
            'resortSlug' => $resortSlug,
        ]);
    }
}
