<?php

namespace App\Modules\Room\Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;
use App\Modules\Room\Models\Room;

class RoomTest extends TestCase
{
    use RefreshDatabase;

    public function test_can_list_rooms(): void
    {
        $response = $this->getJson('/api/rooms');
        $response->assertStatus(200)
                 ->assertJsonStructure([
                     'data',
                     'status',
                     'code',
                     'message'
                 ]);
    }

    public function test_can_create_Room(): void
    {
        $data = ['name' => 'Test Room'];

        $response = $this->postJson('/api/rooms', $data);
        $response->assertStatus(201)
                 ->assertJsonStructure([
                     'data',
                     'status',
                     'code',
                     'message'
                 ]);

        $this->assertDatabaseHas('rooms', $data);
    }

    public function test_can_show_Room(): void
    {
        $Room = Room::factory()->create();

        $response = $this->getJson('/api/rooms/' . $Room->id);
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

    public function test_can_update_Room(): void
    {
        $Room = Room::factory()->create();
        $data = ['name' => 'Updated Room'];

        $response = $this->putJson('/api/rooms/' . $Room->id, $data);
        $response->assertStatus(200)
                 ->assertJsonStructure([
                     'data',
                     'status',
                     'code',
                     'message'
                 ]);

        $this->assertDatabaseHas('rooms', $data);
    }

    public function test_can_delete_Room(): void
    {
        $Room = Room::factory()->create();

        $response = $this->deleteJson('/api/rooms/' . $Room->id);
        $response->assertStatus(200)
                 ->assertJsonStructure([
                     'status',
                     'code',
                     'message'
                 ]);

        $this->assertDatabaseMissing('rooms', ['id' => $Room->id]);
    }

    public function test_validation_errors_on_create(): void
    {
        $response = $this->postJson('/api/rooms', []);
        $response->assertStatus(422)
                 ->assertJsonValidationErrors(['name']);
    }
}
