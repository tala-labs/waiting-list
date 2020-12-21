<?php

return [
    // Database Stuff
    'connection' => null, // Leave null to use default connection. Otherwise use connection name.
    'table' => 'waiting_users', // Leave as waiting_users if you are using our migrations.

    // Routing Stuff
    'redirect_route' => ENV('WAITING_REDIRECT_ROUTE', 'waiting_list__joined'), // Redirect after joining wait list
    'register_route' => ENV('WAITING_REGISTER_ROUTE', 'register'), // Where you want invited users sent?
    'join_route' => ENV('WAITING_JOIN_ROUTE', 'waiting_list__form'), // Where is your join wait list form?

    // Email Invitation Configuration
    'invitation_email_format' => 'markdown', // markdown or html
    'invitation_email_subject' => env('WAITING_INVITATION_SUBJECT', 'Your spot is open!'),
    'invitation_from' => [
        'address' => env('WAITING_FROM_ADDRESS', config('mail.from.address')),
        'name' => env('WAITING_FROM_NAME', config('mail.from.name')),
    ],
    'invitation_expires' => env('WAITING_INVITATION_EXPIRES', 7), // # of days the invitation is good for
    'invitation_block_size' => env('WAITING_INVITATION_BLOCK_SIZE', 10), // # of invitations to send if not specified

];