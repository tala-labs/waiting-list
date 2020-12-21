<?php

namespace ArtisanBuild\WaitingList\Commands;

use ArtisanBuild\WaitingList\Actions\SendInvitation;
use ArtisanBuild\WaitingList\Models\WaitingUser;
use Illuminate\Console\Command;

class Invite extends Command
{
    protected $signature = 'waiting:invite {invitee?}';

    protected $description = 'Invite some people to join the app.';

    private SendInvitation $invitation;

    public function __construct(SendInvitation $invitation)
    {
        parent::__construct();
        $this->invitation = $invitation;
    }

    public function handle(): int
    {
        // First see if we are trying to send an individual invitation.
        if (filter_var($this->argument('invitee'), FILTER_VALIDATE_EMAIL)) {
            $user = WaitingUser::where('email', strtolower($this->argument('invitee')))->first();

            if (!$user) {
                $this->error('We cannot find ' . $this->argument('invitee') . ' on the waiting list.');

                return 1;
            }
            $this->invitation->setUser(
                $user
            )->execute();

            return 0;
        }

        $this->error('Usage Error: `php artisan waiting:invite {invitee?}`.');
        $this->error('The value of invitee, if you use it, must be an email address or an integer.');
        $this->error('If you leave it off we will invite your configured number of invitations:');
        $this->error('Environment Variable: WAITING_LIST_INVITATION_BLOCK_SIZE=' . config('waiting.invitation_block_size'));

        return 1;
    }
}
