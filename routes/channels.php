<?php

use Illuminate\Support\Facades\Broadcast;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Log;

Broadcast::channel('post-list', function () {
    Log::info('PostList - channel');
    return true;
});

