<?php

namespace ArtisanBuild\WaitingList\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\File;

class Versions extends Command
{
    protected $signature = 'waiting:versions';

    protected $description = 'Output the versions of PHP, Laravel, and this package to use in support tickets.';

    public function handle()
    {
        $version = 'Not Found';

        // @todo - Make this populate an array of all our packages and output them all since they will rely on each other
        foreach (json_decode(File::get(base_path('composer.lock')), true)['packages'] as $package) {
            if ($package['name'] == 'artisan-build/waiting-list') {
                $version = $package['version'];
            }
        }

        $this->info('Copy the following information into your bug report when opening an issue:');
        $this->info('PHP version: ' . phpversion());
        $this->info('Laravel version: ' . app()->version());
        $this->info('artisan-build/waiting-list version: ' . $version);
    }
}
