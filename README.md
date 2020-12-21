# Laravel Waiting List (Work In Progress)

Let users sign up for early access to your Laravel app and invite them in over time. 

<a href="https://artisan.build"><img src="https://repository-images.githubusercontent.com/323002393/4261fb80-42ba-11eb-9d7b-2c295d42da7b" alt="Artisan, Build" height="360"></a>

### How To Use

Make sure you're running at least PHP 7.4 and Laravel 7. Then run the following:

`composer require artisan-build/waiting-list`

Then run `php artisan waiting:install` to publish all the assets and `php artisan migrate` to run the migration for the waiting list table.

### Setting the Configuration Options

You can edit your configuration at `config/waiting.php` or you can add the appropriate values to your .env to set the values you want.

### Protecting Your Registration Page

If you want to, you can keep uninvited users from your registration page by simply adding our invitation only component to the page like so:

`<x-invitation-only/>`

With that component in place, users that have been invited can get to the register page by clicking on their invitation link. Anyone else will be redirected to the join waiting list form.

### Inviting Users

To invite users, just run the following artisan command from your production site:

`php artisan waiting.invite {invitee?}`

The invitee value can be left off, in which case the system will invite the number of waiting users set in your configuration, from oldest to newest.

The invitee value can be an integer, in which case the system will invite that number of waiting users, from oldest to newest.

The invitee value can be an email address, in which case the system will invite that user if they exist.

### The Invitation Email

You can set the sender info (name and email address) as well as the subject of the invitation email in your configuration. You can also choose in the configuration whether to use the HTML or Markdown email template. Both templates are published when you install the package so they're fully editable. Just be careful to make sure that `$user->invitation_url` exists so that the user actually gets their invitation link.

### Let's build!