<?php

namespace App\Modules\DeliveryRoute\Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;
use App\Modules\DeliveryRoute\Models\DeliveryRoute;

class DeliveryRouteTest extends TestCase
{
    use RefreshDatabase;

    public function test_can_list_delivery_routes(): void
    {
        $response = $this->getJson('/api/delivery_routes');
        $response->assertStatus(200)
                 ->assertJsonStructure([
                     'data',
                     'status',
                     'code',
                     'message'
                 ]);
    }

    public function test_can_create_DeliveryRoute(): void
    {
        $data = ['name' => 'Test DeliveryRoute'];

        $response = $this->postJson('/api/delivery_routes', $data);
        $response->assertStatus(201)
                 ->assertJsonStructure([
                     'data',
                     'status',
                     'code',
                     'message'
                 ]);

        $this->assertDatabaseHas('delivery_routes', $data);
    }

    public function test_can_show_DeliveryRoute(): void
    {
        $DeliveryRoute = DeliveryRoute::factory()->create();

        $response = $this->getJson('/api/delivery_routes/' . $DeliveryRoute->id);
        $response->assertStatus(200)
                 ->assertJsonStructure([
                     'data' => [
                         'id',
                         'name',
                         'created_at',
                         'updated_at'
                     ],
                     'status',
                     'code',
                     'message'
                 ]);
    }

    public function test_can_update_DeliveryRoute(): void
    {
        $DeliveryRoute = DeliveryRoute::factory()->create();
        $data = ['name' => 'Updated DeliveryRoute'];

        $response = $this->putJson('/api/delivery_routes/' . $DeliveryRoute->id, $data);
        $response->assertStatus(200)
                 ->assertJsonStructure([
                     'data',
                     'status',
                     'code',
                     'message'
                 ]);

        $this->assertDatabaseHas('delivery_routes', $data);
    }

    public function test_can_delete_DeliveryRoute(): void
    {
        $DeliveryRoute = DeliveryRoute::factory()->create();

        $response = $this->deleteJson('/api/delivery_routes/' . $DeliveryRoute->id);
        $response->assertStatus(200)
                 ->assertJsonStructure([
                     'status',
                     'code',
                     'message'
                 ]);

        $this->assertDatabaseMissing('delivery_routes', ['id' => $DeliveryRoute->id]);
    }

    public function test_validation_errors_on_create(): void
    {
        $response = $this->postJson('/api/delivery_routes', []);
        $response->assertStatus(422)
                 ->assertJsonValidationErrors(['name']);
    }
}
