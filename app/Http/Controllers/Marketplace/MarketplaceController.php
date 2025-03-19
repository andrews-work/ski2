<?php

namespace App\Http\Controllers\Marketplace;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

use Inertia\Inertia;

class MarketplaceController extends Controller
{
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

    public function listItem()
    {
        Log::info('marketplace controller - listItem');

        // redirect to item page
        return redirect('marketplace');
    }
}