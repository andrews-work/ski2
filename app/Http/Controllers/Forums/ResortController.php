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
        $resortsCategory = CategoryListModel::where('slug', 'resorts')->firstOrFail();

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
            ->with('topics')
            ->firstOrFail();

        $posts = PostModel::with('user')
            ->where('category_id', $resort->id)
            ->orderBy('created_at', 'desc')
            ->get();

        $travelPosts = $this->getTravelPosts($continentSlug, $countrySlug, $resortSlug)->getData()->travelPosts;
        $restaurantPosts = $this->getRestaurantPosts($continentSlug, $countrySlug, $resortSlug)->getData()->restaurantPosts;
        $rentalsPosts = $this->getRentalsPosts($continentSlug, $countrySlug, $resortSlug)->getData()->rentalsPosts;
        $barPosts = $this->getBarPosts($continentSlug, $countrySlug, $resortSlug)->getData()->barPosts;
        $shopsPosts = $this->getShopsPosts($continentSlug, $countrySlug, $resortSlug)->getData()->shopsPosts;
        $eventsPosts = $this->getEventsPosts($continentSlug, $countrySlug, $resortSlug)->getData()->eventsPosts;
        $newsPosts = $this->getNewsPosts($continentSlug, $countrySlug, $resortSlug)->getData()->newsPosts;
        $mountainPosts = $this->getMountainPosts($continentSlug, $countrySlug, $resortSlug)->getData()->mountainPosts;
        $notskiingPosts = $this->getNotSkiingPosts($continentSlug, $countrySlug, $resortSlug)->getData()->notskiingPosts;
        $parkPosts = $this->getParkPosts($continentSlug, $countrySlug, $resortSlug)->getData()->parkPosts;
        $generalPosts = $this->getGeneralPosts($continentSlug, $countrySlug, $resortSlug)->getData()->generalPosts;
        $backcountryPosts = $this->getBackcountryPosts($continentSlug, $countrySlug, $resortSlug)->getData()->backcountryPosts;
        $suggestionsPosts = $this->getSuggestionsPosts($continentSlug, $countrySlug, $resortSlug)->getData()->suggestionsPosts;

        $categories = $this->getCategories();

        return Inertia::render('Forums', [
            'category' => $resortsCategory,
            'categories' => $categories,
            'continent' => $continent,
            'continentSlug' => $continentSlug,
            'country' => $country,
            'countrySlug' => $countrySlug,
            'resort' => $resort,
            'resortSlug' => $resortSlug,

            'posts' => $posts,
            'travelPosts' => $travelPosts,
            'restaurantPosts' => $restaurantPosts,
            'rentalsPosts' => $rentalsPosts,
            'barPosts' => $barPosts,
            'shopsPosts' => $shopsPosts,
            'eventsPosts' => $eventsPosts,
            'newsPosts' => $newsPosts,
            'mountainPosts' => $mountainPosts,
            'notskiingPosts' => $notskiingPosts,
            'parkPosts' => $parkPosts,
            'generalPosts' => $generalPosts,
            'backcountryPosts' => $backcountryPosts,
            'suggestionsPosts' => $suggestionsPosts,
        ]);
    }

    public function getTravelPosts($continentSlug, $countrySlug, $resortSlug)
    {
        $resort = CategoryListModel::where('slug', $resortSlug)->where('type', 'resort')->firstOrFail();
        $travelTopic = TopicModel::firstOrCreate(['name' => 'Travel'], ['slug' => 'travel']);
        $travelPosts = PostModel::where('topic_id', $travelTopic->id)
            ->where('category_id', $resort->id)
            ->orderBy('created_at', 'desc')
            ->get();

        return response()->json(['travelPosts' => $travelPosts]);
    }

    public function getRestaurantPosts($continentSlug, $countrySlug, $resortSlug)
    {
        $resort = CategoryListModel::where('slug', $resortSlug)->where('type', 'resort')->firstOrFail();
        $restaurantTopic = TopicModel::firstOrCreate(['name' => 'Restaurants'], ['slug' => 'restaurants']);
        $restaurantPosts = PostModel::where('topic_id', $restaurantTopic->id)
            ->where('category_id', $resort->id)
            ->orderBy('created_at', 'desc')
            ->get();

        return response()->json(['restaurantPosts' => $restaurantPosts]);
    }

    public function getBarPosts($continentSlug, $countrySlug, $resortSlug)
    {
        $resort = CategoryListModel::where('slug', $resortSlug)->where('type', 'resort')->firstOrFail();
        $barTopic = TopicModel::firstOrCreate(['name' => 'Bars & Clubs'], ['slug' => 'bars']);
        $barPosts = PostModel::where('topic_id', $barTopic->id)
            ->where('category_id', $resort->id)
            ->orderBy('created_at', 'desc')
            ->get();

        return response()->json(['barPosts' => $barPosts]);
    }

    public function getRentalsPosts($continentSlug, $countrySlug, $resortSlug)
    {
        $resort = CategoryListModel::where('slug', $resortSlug)->where('type', 'resort')->firstOrFail();
        $rentalsTopic = TopicModel::firstOrCreate(['name' => 'Rentals'], ['slug' => 'rentals']);
        $rentalsPosts = PostModel::where('topic_id', $rentalsTopic->id)
            ->where('category_id', $resort->id)
            ->orderBy('created_at', 'desc')
            ->get();

        return response()->json(['rentalsPosts' => $rentalsPosts]);
    }

    public function getShopsPosts($continentSlug, $countrySlug, $resortSlug)
    {
        $resort = CategoryListModel::where('slug', $resortSlug)->where('type', 'resort')->firstOrFail();
        $shopsTopic = TopicModel::firstOrCreate(['name' => 'Shops'], ['slug' => 'shops']);
        $shopsPosts = PostModel::where('topic_id', $shopsTopic->id)
            ->where('category_id', $resort->id)
            ->orderBy('created_at', 'desc')
            ->get();

        return response()->json(['shopsPosts' => $shopsPosts]);
    }

    public function getEventsPosts($continentSlug, $countrySlug, $resortSlug)
    {
        $resort = CategoryListModel::where('slug', $resortSlug)->where('type', 'resort')->firstOrFail();
        $eventsTopic = TopicModel::firstOrCreate(['name' => 'Local Events'], ['slug' => 'events']);
        $eventsPosts = PostModel::where('topic_id', $eventsTopic->id)
            ->where('category_id', $resort->id)
            ->orderBy('created_at', 'desc')
            ->get();

        return response()->json(['eventsPosts' => $eventsPosts]);
    }

    public function getNewsPosts($continentSlug, $countrySlug, $resortSlug)
    {
        $resort = CategoryListModel::where('slug', $resortSlug)->where('type', 'resort')->firstOrFail();
        $newsTopic = TopicModel::firstOrCreate(['name' => 'News'], ['slug' => 'news']);
        $newsPosts = PostModel::where('topic_id', $newsTopic->id)
            ->where('category_id', $resort->id)
            ->orderBy('created_at', 'desc')
            ->get();

        return response()->json(['newsPosts' => $newsPosts]);
    }

    public function getMountainPosts($continentSlug, $countrySlug, $resortSlug)
    {
        $resort = CategoryListModel::where('slug', $resortSlug)->where('type', 'resort')->firstOrFail();
        $mountainTopic = TopicModel::firstOrCreate(['name' => 'Mountain'], ['slug' => 'mountain']);
        $mountainPosts = PostModel::where('topic_id', $mountainTopic->id)
            ->where('category_id', $resort->id)
            ->orderBy('created_at', 'desc')
            ->get();

        return response()->json(['mountainPosts' => $mountainPosts]);
    }

    public function getNotSkiingPosts($continentSlug, $countrySlug, $resortSlug)
    {
        $resort = CategoryListModel::where('slug', $resortSlug)->where('type', 'resort')->firstOrFail();
        $notskiingTopic = TopicModel::firstOrCreate(['name' => 'Not-Skiing Activities'], ['slug' => 'not-skiing']);
        $notskiingPosts = PostModel::where('topic_id', $notskiingTopic->id)
            ->where('category_id', $resort->id)
            ->orderBy('created_at', 'desc')
            ->get();

        return response()->json(['notskiingPosts' => $notskiingPosts]);
    }

    public function getParkPosts($continentSlug, $countrySlug, $resortSlug)
    {
        $resort = CategoryListModel::where('slug', $resortSlug)->where('type', 'resort')->firstOrFail();
        $parkTopic = TopicModel::firstOrCreate(['name' => 'Park'], ['slug' => 'park']);
        $parkPosts = PostModel::where('topic_id', $parkTopic->id)
            ->where('category_id', $resort->id)
            ->orderBy('created_at', 'desc')
            ->get();

        return response()->json(['parkPosts' => $parkPosts]);
    }

    public function getGeneralPosts($continentSlug, $countrySlug, $resortSlug)
    {
        $resort = CategoryListModel::where('slug', $resortSlug)->where('type', 'resort')->firstOrFail();
        $generalTopic = TopicModel::firstOrCreate(['name' => 'General'], ['slug' => 'general']);
        $generalPosts = PostModel::where('topic_id', $generalTopic->id)
            ->where('category_id', $resort->id)
            ->orderBy('created_at', 'desc')
            ->get();

        return response()->json(['generalPosts' => $generalPosts]);
    }

    public function getBackcountryPosts($continentSlug, $countrySlug, $resortSlug)
    {
        $resort = CategoryListModel::where('slug', $resortSlug)->where('type', 'resort')->firstOrFail();
        $backcountryTopic = TopicModel::firstOrCreate(['name' => 'Backcountry'], ['slug' => 'backcountry']);
        $backcountryPosts = PostModel::where('topic_id', $backcountryTopic->id)
            ->where('category_id', $resort->id)
            ->orderBy('created_at', 'desc')
            ->get();

        return response()->json(['backcountryPosts' => $backcountryPosts]);
    }

    public function getSuggestionsPosts($continentSlug, $countrySlug, $resortSlug)
    {
        $resort = CategoryListModel::where('slug', $resortSlug)->where('type', 'resort')->firstOrFail();
        $suggestionsTopic = TopicModel::firstOrCreate(['name' => 'Suggestions'], ['slug' => 'suggestions']);
        $suggestionsPosts = PostModel::where('topic_id', $suggestionsTopic->id)
            ->where('category_id', $resort->id)
            ->orderBy('created_at', 'desc')
            ->get();

        return response()->json(['suggestionsPosts' => $suggestionsPosts]);
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
            'resort' => $resort,
            'posts' => $posts,
            'continentSlug' => $continentSlug,
            'countrySlug' => $countrySlug,
            'resortSlug' => $resortSlug,
        ]);
    }

    // public function showTravel($continentSlug, $countrySlug, $resortSlug)
    // {
    //     Log::info('ResortsCategoryController - showTravel called', [
    //         'continentSlug' => $continentSlug,
    //         'countrySlug' => $countrySlug,
    //         'resortSlug' => $resortSlug,
    //     ]);

    //     $resortsCategory = CategoryListModel::where('slug', 'resorts')->firstOrFail();
    //     Log::info('Resorts category fetched:', ['resortsCategory' => $resortsCategory]);

    //     $continent = CategoryListModel::where('slug', $continentSlug)
    //         ->where('parent_id', $resortsCategory->id)
    //         ->where('type', 'continent')
    //         ->firstOrFail();

    //     $country = CategoryListModel::where('slug', $countrySlug)
    //         ->where('parent_id', $continent->id)
    //         ->where('type', 'country')
    //         ->firstOrFail();

    //     $resort = CategoryListModel::where('slug', $resortSlug)
    //         ->where('parent_id', $country->id)
    //         ->where('type', 'resort')
    //         ->firstOrFail();

    //     // Fetch travel posts
    //     $travelPosts = $this->getTravelPosts($continentSlug, $countrySlug, $resortSlug)->getData()->travelPosts;

    //     Log::info('Travel posts fetched:', ['travelPosts' => $travelPosts]);

    //     return inertia('Forums', [
    //         'resort' => $resort,
    //         'posts' => $travelPosts, // Pass travel posts to the view
    //         'continentSlug' => $continentSlug,
    //         'countrySlug' => $countrySlug,
    //         'resortSlug' => $resortSlug,
    //         'isTravelPage' => true, // Add a flag to identify the Travel page
    //     ]);
    // }

    // public function showRestaurant($continentSlug, $countrySlug, $resortSlug)
    // {
    //     Log::info('ResortsCategoryController - showRestaurant called', [
    //         'continentSlug' => $continentSlug,
    //         'countrySlug' => $countrySlug,
    //         'resortSlug' => $resortSlug,
    //     ]);

    //     $resortsCategory = CategoryListModel::where('slug', 'resorts')->firstOrFail();
    //     Log::info('Resorts category fetched:', ['resortsCategory' => $resortsCategory]);

    //     $continent = CategoryListModel::where('slug', $continentSlug)
    //         ->where('parent_id', $resortsCategory->id)
    //         ->where('type', 'continent')
    //         ->firstOrFail();

    //     $country = CategoryListModel::where('slug', $countrySlug)
    //         ->where('parent_id', $continent->id)
    //         ->where('type', 'country')
    //         ->firstOrFail();

    //     $resort = CategoryListModel::where('slug', $resortSlug)
    //         ->where('parent_id', $country->id)
    //         ->where('type', 'resort')
    //         ->firstOrFail();

    //     // Fetch restaurant posts
    //     $restaurantPosts = $this->getRestaurantPosts($continentSlug, $countrySlug, $resortSlug)->getData()->restaurantPosts;

    //     Log::info('Restaurant posts fetched:', ['restaurantPosts' => $restaurantPosts]);

    //     return inertia('Forums', [
    //         'resort' => $resort,
    //         'posts' => $restaurantPosts, // Pass restaurant posts to the view
    //         'continentSlug' => $continentSlug,
    //         'countrySlug' => $countrySlug,
    //         'resortSlug' => $resortSlug,
    //         'isRestaurantPage' => true, // Add a flag to identify the Restaurant page
    //     ]);
    // }

}
