<?php

namespace App\Modules\DeliveryPlace\Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;
use App\Modules\DeliveryPlace\Models\DeliveryPlace;

class DeliveryPlaceTest extends TestCase
{
    use RefreshDatabase;

    public function test_can_list_delivery_places(): void
    {
        $response = $this->getJson('/api/delivery_places');
        $response->assertStatus(200)
                 ->assertJsonStructure([
                     'data',
                     'status',
                     'code',
                     'message'
                 ]);
    }

    public function test_can_create_DeliveryPlace(): void
    {
        $data = ['name' => 'Test DeliveryPlace'];

        $response = $this->postJson('/api/delivery_places', $data);
        $response->assertStatus(201)
                 ->assertJsonStructure([
                     'data',
                     'status',
                     'code',
                     'message'
                 ]);

        $this->assertDatabaseHas('delivery_places', $data);
    }

    public function test_can_show_DeliveryPlace(): void
    {
        $DeliveryPlace = DeliveryPlace::factory()->create();

        $response = $this->getJson('/api/delivery_places/' . $DeliveryPlace->id);
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

    public function test_can_update_DeliveryPlace(): void
    {
        $DeliveryPlace = DeliveryPlace::factory()->create();
        $data = ['name' => 'Updated DeliveryPlace'];

        $response = $this->putJson('/api/delivery_places/' . $DeliveryPlace->id, $data);
        $response->assertStatus(200)
                 ->assertJsonStructure([
                     'data',
                     'status',
                     'code',
                     'message'
                 ]);

        $this->assertDatabaseHas('delivery_places', $data);
    }

    public function test_can_delete_DeliveryPlace(): void
    {
        $DeliveryPlace = DeliveryPlace::factory()->create();

        $response = $this->deleteJson('/api/delivery_places/' . $DeliveryPlace->id);
        $response->assertStatus(200)
                 ->assertJsonStructure([
                     'status',
                     'code',
                     'message'
                 ]);

        $this->assertDatabaseMissing('delivery_places', ['id' => $DeliveryPlace->id]);
    }

    public function test_validation_errors_on_create(): void
    {
        $response = $this->postJson('/api/delivery_places', []);
        $response->assertStatus(422)
                 ->assertJsonValidationErrors(['name']);
    }
}
