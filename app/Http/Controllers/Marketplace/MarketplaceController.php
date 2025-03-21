<?php

namespace App\Http\Controllers\Marketplace;

use Illuminate\Support\Facades\Storage;
use App\Http\Controllers\Controller;
use App\Http\Requests\ListingRequest;
use App\Models\ListingCategoryModel;
use App\Models\ListingModel;
use App\Policies\ListingPolicy;
use Illuminate\Support\Facades\Auth;
use App\Services\ListingService;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Inertia\Inertia;

class MarketplaceController extends Controller
{
    use AuthorizesRequests;

    public function index()
    {
        return Inertia::render('Marketplace', [
            'currentView' => 'buy',
        ]);
    }

    public function sell()
    {
        return Inertia::render('Marketplace', [
            'currentView' => 'sell',
        ]);
    }

    public function wishlist()
    {
        return Inertia::render('Marketplace', [
            'currentView' => 'wishlist',
        ]);
    }

    public function listings()
    {
        $listings = ListingModel::with(['user', 'category', 'images'])->get();
        $this->generatePresignedUrls($listings);

        return Inertia::render('Marketplace', [
            'currentView' => 'listingList',
            'listings' => $listings ?? [],
        ]);
    }

    public function myListings()
    {
        $userId = Auth::id();
        $listings = ListingModel::with(['user', 'category', 'images'])
            ->where('user_id', $userId)
            ->get();

        $this->generatePresignedUrls($listings);

        return Inertia::render('Marketplace', [
            'currentView' => 'myListings',
            'listings' => $listings ?? [],
        ]);
    }

    public function getCategories()
    {
        $categories = ListingCategoryModel::all();
        return response()->json($categories);
    }

    public function createListing(ListingRequest $request, ListingService $listingService)
    {
        $this->authorize('create', ListingModel::class);

        try {
            $listing = $listingService->createListing($request);

            return redirect()->route('marketplace.showListing', ['listingId' => $listing->id])
                ->with('success', 'Listing created successfully!');

        } catch (\Exception $e) {
            Log::error('Error creating listing: ' . $e->getMessage());
            return redirect()->back()->with('error', 'An error occurred while creating the listing.');
        }
    }

    public function showListing($listingId)
    {
        $listing = ListingModel::with(['user', 'category', 'images'])->findOrFail($listingId);
        $this->generatePresignedUrls(collect([$listing]));

        return Inertia::render('Marketplace', [
            'currentView' => 'listing',
            'listing' => $listing,
        ]);
    }

    public function showListingCategory($categoryId)
    {
        $listings = ListingModel::where('category_id', $categoryId)
            ->with(['user', 'category', 'images'])
            ->get();

        $this->generatePresignedUrls($listings);

        $category = ListingCategoryModel::find($categoryId);

        return Inertia::render('Marketplace', [
            'listings' => $listings,
            'category' => $category,
        ]);
    }

    private function generatePresignedUrls($listings)
    {
        $listings->each(function ($listing) {
            $listing->images->each(function ($image) {
                try {
                    if (method_exists(Storage::disk('s3'), 'temporaryUrl')) {
                        $image->url = Storage::disk('s3')->temporaryUrl(
                            $image->path,
                            now()->addMinutes(30)
                        );
                    } else {
                        Log::error('temporaryUrl method does not exist on S3 disk.');
                        $image->url = null;
                    }
                } catch (\Exception $e) {
                    Log::error('Error generating pre-signed URL: ' . $e->getMessage());
                    $image->url = null;
                }
            });
        });
    }
}





// to do:

// crud
// implemet shopping cart
// payment page - crypto + stripe?