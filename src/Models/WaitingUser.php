<?php

namespace ArtisanBuild\WaitingList\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\URL;

class WaitingUser extends Model
{
    protected $guarded = [];

    public function __construct(array $attributes = [])
    {
        parent::__construct($attributes);

        $this->setTable(config('waiting_list.table', 'waiting_users'));

        if (!is_null(config('waiting_list.connection'))) {
            $this->setConnection(config('waiting_list.connection'));
        }
    }

    public function getInvitationUrlAttribute()
    {
        return URL::signedRoute(config('waiting.registration_route', 'register'),
            ['waiting_user' => $this],
            Carbon::now()->addDays(config('waiting.invitation_expires', '7'))
        );
    }
}
