<?php

namespace App\Policies;

use App\Models\ListingModel;
use App\Models\User;
use Illuminate\Auth\Access\Response;
use Illuminate\Support\Facades\Log;

class ListingPolicy
{

    public function create(User $user): bool
    {
        Log::info('ListingPolicy - create');
        return $user !== null;
    }
}
