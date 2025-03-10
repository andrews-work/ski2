<?php

namespace App\Providers;

use App\Models\Forums\PostCommentModel;
use App\Models\Forums\PostModel;
use App\Policies\PostCommentPolicy;
use App\Policies\PostPolicy;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Gate;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        Gate::policy(PostModel::class, PostPolicy::class);
        Gate::policy(PostCommentModel::class, PostCommentPolicy::class);
    }
}
