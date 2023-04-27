<?php

namespace Tests\Feature;

use App\Api\Facades\Api;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class ApiTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function get_users_from_api() {
        $response = Api::getUsers();
        $this->assertNotEmpty($response['message']['data']);
    }
}
