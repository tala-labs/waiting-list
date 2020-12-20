<?php

namespace ArtisanBuild\WaitingList;

use Illuminate\Support\ServiceProvider;

class WaitingListProvider extends ServiceProvider
{
    public function boot(): void
    {
        $this->loadMigrationsFrom(__DIR__.'/../database/migrations');
    }

    public function register(): void
    {
        $this->mergeConfigFrom(__DIR__ . '/../config/config.php', 'laravel-package-template');
    }
}
