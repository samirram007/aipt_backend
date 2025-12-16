<?php

namespace App\Modules\Vehicle\Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;
use App\Modules\Vehicle\Models\Vehicle;

class VehicleTest extends TestCase
{
    use RefreshDatabase;

    public function test_can_list_vehicles(): void
    {
        $response = $this->getJson('/api/vehicles');
        $response->assertStatus(200)
                 ->assertJsonStructure([
                     'data',
                     'status',
                     'code',
                     'message'
                 ]);
    }

    public function test_can_create_Vehicle(): void
    {
        $data = ['name' => 'Test Vehicle'];

        $response = $this->postJson('/api/vehicles', $data);
        $response->assertStatus(201)
                 ->assertJsonStructure([
                     'data',
                     'status',
                     'code',
                     'message'
                 ]);

        $this->assertDatabaseHas('vehicles', $data);
    }

    public function test_can_show_Vehicle(): void
    {
        $Vehicle = Vehicle::factory()->create();

        $response = $this->getJson('/api/vehicles/' . $Vehicle->id);
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

    public function test_can_update_Vehicle(): void
    {
        $Vehicle = Vehicle::factory()->create();
        $data = ['name' => 'Updated Vehicle'];

        $response = $this->putJson('/api/vehicles/' . $Vehicle->id, $data);
        $response->assertStatus(200)
                 ->assertJsonStructure([
                     'data',
                     'status',
                     'code',
                     'message'
                 ]);

        $this->assertDatabaseHas('vehicles', $data);
    }

    public function test_can_delete_Vehicle(): void
    {
        $Vehicle = Vehicle::factory()->create();

        $response = $this->deleteJson('/api/vehicles/' . $Vehicle->id);
        $response->assertStatus(200)
                 ->assertJsonStructure([
                     'status',
                     'code',
                     'message'
                 ]);

        $this->assertDatabaseMissing('vehicles', ['id' => $Vehicle->id]);
    }

    public function test_validation_errors_on_create(): void
    {
        $response = $this->postJson('/api/vehicles', []);
        $response->assertStatus(422)
                 ->assertJsonValidationErrors(['name']);
    }
}
