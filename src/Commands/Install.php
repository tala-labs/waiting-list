<?php

namespace ArtisanBuild\WaitingList\Commands;

use Illuminate\Console\Command;

class Install extends Command
{
    protected $signature = 'waiting:install';

    protected $description = 'A shortcut command to publish the publishables.';

    public function handle()
    {
        $this->call('vendor:publish', ['--provider' => 'ArtisanBuild\\WaitingList\\WaitingListProvider', '--force' => true]);
        $this->info('Installation finished');
    }
}
