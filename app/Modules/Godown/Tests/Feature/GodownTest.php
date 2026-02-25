<?php

namespace App\Modules\Godown\Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;
use App\Modules\Godown\Models\Godown;

class GodownTest extends TestCase
{
    use RefreshDatabase;

    public function test_can_list_godowns(): void
    {
        $response = $this->getJson('/api/godowns');
        $response->assertStatus(200)
                 ->assertJsonStructure([
                     'data',
                     'status',
                     'code',
                     'message'
                 ]);
    }

    public function test_can_create_Godown(): void
    {
        $data = ['name' => 'Test Godown'];

        $response = $this->postJson('/api/godowns', $data);
        $response->assertStatus(201)
                 ->assertJsonStructure([
                     'data',
                     'status',
                     'code',
                     'message'
                 ]);

        $this->assertDatabaseHas('godowns', $data);
    }

    public function test_can_show_Godown(): void
    {
        $Godown = Godown::factory()->create();

        $response = $this->getJson('/api/godowns/' . $Godown->id);
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

    public function test_can_update_Godown(): void
    {
        $Godown = Godown::factory()->create();
        $data = ['name' => 'Updated Godown'];

        $response = $this->putJson('/api/godowns/' . $Godown->id, $data);
        $response->assertStatus(200)
                 ->assertJsonStructure([
                     'data',
                     'status',
                     'code',
                     'message'
                 ]);

        $this->assertDatabaseHas('godowns', $data);
    }

    public function test_can_delete_Godown(): void
    {
        $Godown = Godown::factory()->create();

        $response = $this->deleteJson('/api/godowns/' . $Godown->id);
        $response->assertStatus(200)
                 ->assertJsonStructure([
                     'status',
                     'code',
                     'message'
                 ]);

        $this->assertDatabaseMissing('godowns', ['id' => $Godown->id]);
    }

    public function test_validation_errors_on_create(): void
    {
        $response = $this->postJson('/api/godowns', []);
        $response->assertStatus(422)
                 ->assertJsonValidationErrors(['name']);
    }
}
