<?php

namespace Tests\Feature;

use App\Console\Commands\ApiSyncUsers;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class ApiSyncUsersTest extends TestCase
{

    use WithFaker, RefreshDatabase;

    /** @test */
    public function sync_users(): void {
        $users[] = [
            'first_name' => $this->faker->firstName,
            'last_name' => $this->faker->lastName,
            'email' => $this->faker->email,
            'avatar' => $this->faker->url,
        ];

        (new ApiSyncUsers())->updateOrCreateUsers($users);

        $this->assertDatabaseHas('users', $users[0]);
    }
}
