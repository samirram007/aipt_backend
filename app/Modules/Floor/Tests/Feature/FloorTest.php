<?php

namespace App\Modules\Floor\Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;
use App\Modules\Floor\Models\Floor;

class FloorTest extends TestCase
{
    use RefreshDatabase;

    public function test_can_list_floors(): void
    {
        $response = $this->getJson('/api/floors');
        $response->assertStatus(200)
                 ->assertJsonStructure([
                     'data',
                     'status',
                     'code',
                     'message'
                 ]);
    }

    public function test_can_create_Floor(): void
    {
        $data = ['name' => 'Test Floor'];

        $response = $this->postJson('/api/floors', $data);
        $response->assertStatus(201)
                 ->assertJsonStructure([
                     'data',
                     'status',
                     'code',
                     'message'
                 ]);

        $this->assertDatabaseHas('floors', $data);
    }

    public function test_can_show_Floor(): void
    {
        $Floor = Floor::factory()->create();

        $response = $this->getJson('/api/floors/' . $Floor->id);
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

    public function test_can_update_Floor(): void
    {
        $Floor = Floor::factory()->create();
        $data = ['name' => 'Updated Floor'];

        $response = $this->putJson('/api/floors/' . $Floor->id, $data);
        $response->assertStatus(200)
                 ->assertJsonStructure([
                     'data',
                     'status',
                     'code',
                     'message'
                 ]);

        $this->assertDatabaseHas('floors', $data);
    }

    public function test_can_delete_Floor(): void
    {
        $Floor = Floor::factory()->create();

        $response = $this->deleteJson('/api/floors/' . $Floor->id);
        $response->assertStatus(200)
                 ->assertJsonStructure([
                     'status',
                     'code',
                     'message'
                 ]);

        $this->assertDatabaseMissing('floors', ['id' => $Floor->id]);
    }

    public function test_validation_errors_on_create(): void
    {
        $response = $this->postJson('/api/floors', []);
        $response->assertStatus(422)
                 ->assertJsonValidationErrors(['name']);
    }
}
