@component('mail::message')
# Your Spot Is Ready

You are invited to register now.

@component('mail::button', ['url' => $user->invitation_url])
Register Now
@endcomponent

Thanks,<br>
{{ config('app.name') }}
@endcomponent