<?php

namespace Tonymans33\SearchableWithRecent\Providers;

use Illuminate\Support\ServiceProvider;

class RecentSearchServiceProvider extends ServiceProvider
{
    public function boot()
    {
        if ($this->app->runningInConsole()) {
            // Publish migrations with tag
            $this->publishes([
                __DIR__ . '/../../database/migrations' => database_path('migrations'),
            ], 'searchable-recent-migrations');
            
            // Publish config with tag
            $this->publishes([
                __DIR__ . '/../../config/recentsearch.php' => config_path('recentsearch.php'),
            ], 'searchable-recent-config');

            // Load migrations
            $this->loadMigrationsFrom(__DIR__ . '/../../database/migrations');
        }
    }

    public function register()
    {
        $this->mergeConfigFrom(__DIR__ . '/../../config/recentsearch.php', 'recentsearch');
    }
}