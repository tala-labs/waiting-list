<?php

namespace ArtisanBuild\WaitingList;

use ArtisanBuild\WaitingList\Actions\SendInvitation;
use ArtisanBuild\WaitingList\Commands\Install;
use ArtisanBuild\WaitingList\Commands\Invite;
use ArtisanBuild\WaitingList\Commands\Versions;
use Faker\Generator;
use Illuminate\Support\ServiceProvider;

class WaitingListProvider extends ServiceProvider
{
    public function boot(): void
    {
        $this->loadMigrationsFrom(__DIR__ . '/../database/migrations');
        $this->loadRoutesFrom(__DIR__ . '/../routes/web.php');

        $this->loadViewsFrom(__DIR__ . '/../resources/views', 'waiting');

        $this->publishes([
            __DIR__ . '/../resources/views' => resource_path('views/vendor/waiting'),
        ]);

        $this->publishes([
            __DIR__ . '/../config/config.php' => config_path('waiting.php'),
        ], 'config');

        $this->publishes([
            __DIR__ . '/../database/migrations/' => database_path('migrations'),
        ], 'migrations');

        if ($this->app->runningInConsole()) {
            $this->commands([
                Versions::class,
                Invite::class,
                Install::class,
            ]);
        }
    }

    public function register(): void
    {
        $this->mergeConfigFrom(__DIR__ . '/../config/config.php', 'waiting');

        $this->app->bind(SendInvitation::class, function ($app) {
            return new SendInvitation();
        });
    }
}
