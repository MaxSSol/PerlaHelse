<?php

namespace Tests\Feature\Api;

use App\User;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class ServiceTypeControllerTest extends TestCase
{
    use DatabaseMigrations;

    protected $user;

    protected function setUp(): void
    {
        parent::setUp();
        $this->user = User::factory()->create()->first();
    }

    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function test_get_service_types()
    {
        $response = $this->actingAs($this->user)->get('/api/service/types');

        $response->assertStatus(200);
        $response->assertJsonPath('success', true);
    }
}
