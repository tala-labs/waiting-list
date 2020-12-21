<?php

namespace ArtisanBuild\WaitingList\Mail;

use ArtisanBuild\WaitingList\Models\WaitingUser;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class InvitationMailer extends Mailable
{
    use SerializesModels;
    use Queueable;

    public WaitingUser $user;

    public function __construct(WaitingUser $user)
    {
        $this->user = $user;
    }

    public function build()
    {
        if (config('waiting.invitation_email_format') === 'markdown') {
            return $this->from(config('waiting.invitation_from'))
                ->subject(config('waiting.invitation_email_subject'))
                ->markdown('waiting::emails.invitation_markdown');
        }

        return $this->from(config('waiting.invitation_from'))
            ->subject(config('waiting.invitation_email_subject'))
            ->$this->view('waiting::emails.invitation');
    }
}
