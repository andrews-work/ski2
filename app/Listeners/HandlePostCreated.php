<?php

namespace App\Listeners;

use App\Events\PostCreated;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\Log;

class HandlePostCreated
{
    public function __construct()
    {
    }

    public function handle(PostCreated $event): void
    {
        Log::info('listener - postCreated', ['post' => $event->post]);
        // should i re-render the PostList componnet here?
    }
}
