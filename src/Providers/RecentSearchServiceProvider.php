<?php

namespace YourVendor\YourPackage\Providers;

use Illuminate\Support\ServiceProvider;

class RecentSearchServiceProvider extends ServiceProvider
{
    public function boot()
    {
        // Load migrations
        $this->loadMigrationsFrom(__DIR__ . '/../../database/migrations');

        // Optional: Load config (if you have config files)
        $this->publishes([
            __DIR__ . '/../../config/recentsearch.php' => config_path('recentsearch.php'),
        ]);
    }

    public function register()
    {
        // Merge config (if needed)
        $this->mergeConfigFrom(__DIR__ . '/../../config/recentsearch.php', 'recentsearch');
    }
}
