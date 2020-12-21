<?php


namespace ArtisanBuild\WaitingList\Commands;


use Illuminate\Console\Command;

class Invite extends Command
{
    protected $signature = 'waiting:invite {invitee}';

    protected $description = 'Invite some people to join the app.';

    public function handle()
    {

    }
}