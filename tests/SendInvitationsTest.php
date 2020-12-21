<?php

namespace Tests;

use ArtisanBuild\WaitingList\Mail\InvitationMailer;
use ArtisanBuild\WaitingList\Models\WaitingUser;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Route;

class SendInvitationsTest extends TestCase
{
    use RefreshDatabase;
    use WithFaker;

    /**
     * @var WaitingUser[]|\Illuminate\Database\Eloquent\Collection
     */
    private $users;

    public function setUp(): void
    {
        parent::setUp();

        Mail::fake();

        for ($i = 0; $i <= 21; $i++) {
            WaitingUser::create([
                'name'  => $this->faker->name,
                'email' => $this->faker->email,
            ]);
        }

        Route::view('/register', 'waiting::test.register')->name('register');

        $this->users = WaitingUser::all();
    }

    /** @test */
    public function itCanInviteByEmail()
    {
        Mail::assertNothingSent();

        $this->artisan('waiting:invite ' . $this->users->first()->email)
            ->assertExitCode(0);

        Mail::assertSent(InvitationMailer::class);
    }

    /** @test */
    public function itHandlesNotFoundEmail()
    {
        Mail::assertNothingSent();

        $this->artisan('waiting:invite doesnotexist@artisan.build')
            ->assertExitCode(1);

        Mail::assertNothingSent();
    }

    /** @test */
    public function itHandlesInvalidParameterSent()
    {
        Mail::assertNothingSent();

        $this->artisan('waiting:invite avocado')
            ->assertExitCode(2);

        Mail::assertNothingSent();
    }

    /** @test */
    public function itWillSendASpecifiedNumberOfInvitations()
    {
        Mail::assertNothingSent();

        $this->artisan('waiting:invite 5')
            ->assertExitCode(0);

        Mail::assertSent(InvitationMailer::class, 5);
    }

    /** @test */
    public function itWillSendTheDefaultNumberOfInvitations()
    {
        Mail::assertNothingSent();

        $this->artisan('waiting:invite')
            ->assertExitCode(0);

        Mail::assertSent(InvitationMailer::class, 10);
    }

    /** @test */
    public function invitationOnlyComponentProtectsRegisterRoute()
    {
        $this->withoutExceptionHandling()
            ->get(route('register'))
            ->assertSuccessful()
            ->assertSee('document.location.href = ')
            ->assertSee(route('waiting_list__form'));
    }

    /** @test */
    public function invitationOnlyComponentAllowsSignedUrls()
    {
        $this->get(WaitingUser::first()->invitation_url)
            ->assertSuccessful()
            ->assertSee('Register Route Found')
            ->assertDontSee('document.location.href');
    }
}
