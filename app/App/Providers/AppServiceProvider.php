<?php

namespace App\App\Providers;

use App\Domain\Movies\Models\Movie;
use App\Domain\Movies\Observers\MovieObserver;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        Movie::observe(MovieObserver::class);
    }
}
