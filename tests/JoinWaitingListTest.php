<?php

namespace Tests;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;

class JoinWaitingListTest extends TestCase
{
    use RefreshDatabase;
    use WithFaker;

    private array $new;

    public function setUp(): void
    {
        parent::setUp();

        $this->new = [
            'name'  => $this->faker->name,
            'email' => $this->faker->email,
        ];
    }

    /** @test */
    public function itAddsAUserIfValidDataProvided()
    {
        $this->withoutExceptionHandling()
            ->post(route('waiting_list__join'), $this->new)
            ->assertStatus(302)
            ->assertSee(route('waiting_list__joined'));

        $this->assertDatabaseHas(config('waiting.table'), $this->new);
    }

    /** @test */
    public function itReturnsJsonIfCalledFor()
    {
        $this->withoutExceptionHandling()
            ->withHeaders([
                'Accept' => 'application/json',
            ])
            ->post(route('waiting_list__join'), $this->new)
            ->assertSuccessful()
            ->assertJson($this->new);

        $this->assertDatabaseHas(config('waiting.table'), $this->new);
    }
}
