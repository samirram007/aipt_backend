<?php

namespace App\Modules\DeliveryVehicle\Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;
use App\Modules\DeliveryVehicle\Models\DeliveryVehicle;

class DeliveryVehicleTest extends TestCase
{
    use RefreshDatabase;

    public function test_can_list_delivery_vehicles(): void
    {
        $response = $this->getJson('/api/delivery_vehicles');
        $response->assertStatus(200)
                 ->assertJsonStructure([
                     'data',
                     'status',
                     'code',
                     'message'
                 ]);
    }

    public function test_can_create_DeliveryVehicle(): void
    {
        $data = ['name' => 'Test DeliveryVehicle'];

        $response = $this->postJson('/api/delivery_vehicles', $data);
        $response->assertStatus(201)
                 ->assertJsonStructure([
                     'data',
                     'status',
                     'code',
                     'message'
                 ]);

        $this->assertDatabaseHas('delivery_vehicles', $data);
    }

    public function test_can_show_DeliveryVehicle(): void
    {
        $DeliveryVehicle = DeliveryVehicle::factory()->create();

        $response = $this->getJson('/api/delivery_vehicles/' . $DeliveryVehicle->id);
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

    public function test_can_update_DeliveryVehicle(): void
    {
        $DeliveryVehicle = DeliveryVehicle::factory()->create();
        $data = ['name' => 'Updated DeliveryVehicle'];

        $response = $this->putJson('/api/delivery_vehicles/' . $DeliveryVehicle->id, $data);
        $response->assertStatus(200)
                 ->assertJsonStructure([
                     'data',
                     'status',
                     'code',
                     'message'
                 ]);

        $this->assertDatabaseHas('delivery_vehicles', $data);
    }

    public function test_can_delete_DeliveryVehicle(): void
    {
        $DeliveryVehicle = DeliveryVehicle::factory()->create();

        $response = $this->deleteJson('/api/delivery_vehicles/' . $DeliveryVehicle->id);
        $response->assertStatus(200)
                 ->assertJsonStructure([
                     'status',
                     'code',
                     'message'
                 ]);

        $this->assertDatabaseMissing('delivery_vehicles', ['id' => $DeliveryVehicle->id]);
    }

    public function test_validation_errors_on_create(): void
    {
        $response = $this->postJson('/api/delivery_vehicles', []);
        $response->assertStatus(422)
                 ->assertJsonValidationErrors(['name']);
    }
}
