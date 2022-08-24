<?php

namespace Tests\Feature\Api;

use App\User;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class DocumentPriceControllerTest extends TestCase
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
    public function test_get_document_price()
    {
        $response = $this->actingAs($this->user)->call('GET','/api/document/price', [
            'CitySender' => 'db5c88de-391c-11dd-90d9-001a92567626',
            'CityRecipient' => 'db5c88f0-391c-11dd-90d9-001a92567626',
            'CargoType' => 'Documents',
            'ServiceType' => 'WarehouseWarehouse',
            'Cost' => '2500',
            'SeatsAmount' => '1',
            'PackCount' => '1',
            'PackRef' => '63d9608e-3107-11e5-add9-005056887b8d',
            'Weight' => '0.1'
        ]);

        $response->assertStatus(200);
        $response->assertJsonPath('success', true);
        $response->assertJsonPath('data.0.AssessedCost', 2500);
    }
}
