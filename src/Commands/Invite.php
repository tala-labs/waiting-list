<?php

namespace ArtisanBuild\WaitingList\Commands;

use ArtisanBuild\WaitingList\Actions\SendInvitation;
use ArtisanBuild\WaitingList\Models\WaitingUser;
use Illuminate\Console\Command;
use Illuminate\Support\Collection;

class Invite extends Command
{
    protected $signature = 'waiting:invite {invitee?}';

    protected $description = 'Invite some people to join the app.';

    private SendInvitation $invitation;

    private Collection $sent;

    public function __construct(SendInvitation $invitation)
    {
        parent::__construct();
        $this->invitation = $invitation;
        $this->sent       = collect([]);
    }

    public function handle(): int
    {
        $invitee = $this->argument('invitee') ?? config('waiting.invitation_block_size');

        // First see if we are trying to send an individual invitation.
        if (filter_var($invitee, FILTER_VALIDATE_EMAIL)) {
            $user = WaitingUser::where('email', strtolower($invitee))->first();

            if (!$user) {
                $this->error('We cannot find ' . $invitee . ' on the waiting list.');

                return 1;
            }
            $this->invitation->setUser(
                $user
            )->execute();
            $this->info('Invited ' . $user->email);

            return 0;
        }

        if (is_numeric($invitee)) {
            foreach (WaitingUser::where('invited_at', null)->orderBy('created_at')->limit($invitee)->get() as $user) {
                $this->invitation->setUser(
                    $user
                )->execute();
                $this->sent->push($user->email);
            }

            $this->info('Invited ' . $this->sent->join(', ', ', and '));

            return 0;
        }

        $this->error('Usage Error: `php artisan waiting:invite {invitee?}`.');
        $this->error('The value of invitee, if you use it, must be an email address or an integer.');
        $this->error('If you leave it off we will invite your configured number of invitations:');
        $this->error('Environment Variable: WAITING_INVITATION_BLOCK_SIZE=' . config('waiting.invitation_block_size'));

        return 2;
    }
}
