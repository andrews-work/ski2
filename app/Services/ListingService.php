<?php

namespace App\Services;

use App\Models\ListingModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;

class ListingService
{
    public function createListing(Request $request)
    {
        Log::info('ListingService - Request Data:', $request->all());

        try {
            // Create the listing
            $listing = ListingModel::create([
                'title' => $request->title,
                'description' => $request->description,
                'price' => $request->price,
                'condition' => $request->condition,
                'usage_level' => $request->usage_level,
                'category_id' => $request->category_id,
                'user_id' => Auth::id(),
            ]);

            // Handle image uploads
            if ($request->hasFile('images')) {
                Log::info('ListingService - Images found:', $request->file('images'));
                foreach ($request->file('images') as $image) {

                    if (method_exists(Storage::disk('s3'), 'url')) {
                        Log::info('URL method exists on S3 disk.');
                    } else {
                        Log::error('URL method does not exist on S3 disk.');
                    }
                    // Store the image in the S3 bucket
                    $path = $image->store('listings/images', 's3'); // Use 's3' disk
                    $url = Storage::disk('s3')->url($path); // Generate the full URL
                    Log::info('ListingService - Image stored at:', [$path]);

                    // Save the image path and URL to the database
                    $listing->images()->create([
                        'path' => $path,
                        'url' => $url,
                    ]);
                }
            }

            if ($request->hasFile('videos')) {
                Log::info('ListingService - Videos found:', $request->file('videos'));
                foreach ($request->file('videos') as $video) {

                    if (method_exists(Storage::disk('s3'), 'url')) {
                        Log::info('URL method exists on S3 disk.');
                    } else {
                        Log::error('URL method does not exist on S3 disk.');
                    }

                    $path = $video->store('listings/videos', 's3'); // Use 's3' disk
                    $url = Storage::disk('s3')->url($path); // Generate the full URL
                    Log::info('ListingService - Video stored at:', [$path]);

                    // Save the video path and URL to the database
                    $listing->videos()->create([
                        'path' => $path,
                        'url' => $url,
                    ]);
                }
            }

            return $listing;
        } catch (\Exception $e) {
            Log::error('ListingService - Error creating listing:', ['error' => $e->getMessage()]);
            throw $e;
        }
    }
}

