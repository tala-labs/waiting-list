<?php

namespace ArtisanBuild\WaitingList;

use ArtisanBuild\WaitingList\Mail\InvitationMailer;
use Illuminate\Support\ServiceProvider;

class WaitingListProvider extends ServiceProvider
{
    public function boot(): void
    {
        $this->loadMigrationsFrom(__DIR__.'/../database/migrations');
        $this->loadRoutesFrom(__DIR__.'/../routes/web.php');

        $this->loadViewsFrom(__DIR__.'/../resources/views', 'waiting');

        $this->publishes([
            __DIR__.'/../resources/views' => resource_path('views/vendor/waiting'),
        ]);

        if ($this->app->runningInConsole()) {
            $this->commands([
            ]);
        }
    }

    public function register(): void
    {
        $this->mergeConfigFrom(__DIR__ . '/../config/config.php', 'waiting');

        $this->app->bind(InvitationMailer::class, config('waiting.invitation_mailer'));
    }
}
