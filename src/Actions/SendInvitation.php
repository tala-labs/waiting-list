<?php


namespace ArtisanBuild\WaitingList\Actions;


use ArtisanBuild\WaitingList\Mail\InvitationMailer;
use ArtisanBuild\WaitingList\Models\WaitingUser;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\URL;

class SendInvitation
{
    public function __construct(WaitingUser $user)
    {
        $this->user = $user;

    }

    public function execute()
    {
        $this->user->invitation_url = URL::signedRoute(config('waiting.registration_route', 'register'),
            ['waiting_user' => $this->user],
            Carbon::now()->addDays(config('waiting.invitation_expires', '7'))
        );

    }
}