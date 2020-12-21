<?php

namespace ArtisanBuild\WaitingList\Actions;

use ArtisanBuild\WaitingList\Mail\InvitationMailer;
use ArtisanBuild\WaitingList\Models\WaitingUser;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Mail;

class SendInvitation
{
    private WaitingUser $user;

    public function setUser(WaitingUser $user): self
    {
        $this->user = $user;

        return $this;
    }

    public function execute()
    {
        Mail::to($this->user)->send(new InvitationMailer($this->user));

        $this->user->update(['invited_at' => Carbon::now()]);
    }
}
