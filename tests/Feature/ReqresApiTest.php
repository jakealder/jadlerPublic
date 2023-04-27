<?php

namespace Tests\Feature;

use App\Api\Facades\Api;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class ReqresApiTest extends TestCase
{
    /** @test */
    public function reqres_api_connection_success_response() {
        $response = Api::channel('reqres')->getUsers();
        $this->assertTrue($response['status'] === 'success');
    }
    /** @test */
    public function reqres_api_get_users() {
        $response = Api::channel('reqres')->getUsers();
        $this->assertNotEmpty($response['message']['data']);
    }

}
