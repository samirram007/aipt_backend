<?php

namespace App\Modules\Building\Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;
use App\Modules\Building\Models\Building;

class BuildingTest extends TestCase
{
    use RefreshDatabase;

    public function test_can_list_buildings(): void
    {
        $response = $this->getJson('/api/buildings');
        $response->assertStatus(200)
                 ->assertJsonStructure([
                     'data',
                     'status',
                     'code',
                     'message'
                 ]);
    }

    public function test_can_create_Building(): void
    {
        $data = ['name' => 'Test Building'];

        $response = $this->postJson('/api/buildings', $data);
        $response->assertStatus(201)
                 ->assertJsonStructure([
                     'data',
                     'status',
                     'code',
                     'message'
                 ]);

        $this->assertDatabaseHas('buildings', $data);
    }

    public function test_can_show_Building(): void
    {
        $Building = Building::factory()->create();

        $response = $this->getJson('/api/buildings/' . $Building->id);
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

    public function test_can_update_Building(): void
    {
        $Building = Building::factory()->create();
        $data = ['name' => 'Updated Building'];

        $response = $this->putJson('/api/buildings/' . $Building->id, $data);
        $response->assertStatus(200)
                 ->assertJsonStructure([
                     'data',
                     'status',
                     'code',
                     'message'
                 ]);

        $this->assertDatabaseHas('buildings', $data);
    }

    public function test_can_delete_Building(): void
    {
        $Building = Building::factory()->create();

        $response = $this->deleteJson('/api/buildings/' . $Building->id);
        $response->assertStatus(200)
                 ->assertJsonStructure([
                     'status',
                     'code',
                     'message'
                 ]);

        $this->assertDatabaseMissing('buildings', ['id' => $Building->id]);
    }

    public function test_validation_errors_on_create(): void
    {
        $response = $this->postJson('/api/buildings', []);
        $response->assertStatus(422)
                 ->assertJsonValidationErrors(['name']);
    }
}
