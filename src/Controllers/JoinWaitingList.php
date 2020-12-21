<?php

namespace ArtisanBuild\WaitingList\Controllers;

use ArtisanBuild\WaitingList\Models\WaitingUser;
use Illuminate\Http\Request;

class JoinWaitingList
{
    public function __invoke(Request $request)
    {
        $user = WaitingUser::create(
            $request->validate([
                'name'  => ['nullable', 'string', 'max:255'],
                'email' => ['required', 'email', 'max:255'],
            ])
        );

        return $request->expectsJson() ? $user->toJson() : redirect(
            route(config('waiting.redirect_route', 'waiting_list__joined'))
        );
    }
}
