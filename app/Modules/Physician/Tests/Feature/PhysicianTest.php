<?php

namespace App\Modules\Physician\Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;
use App\Modules\Physician\Models\Physician;

class PhysicianTest extends TestCase
{
    use RefreshDatabase;

    public function test_can_list_physicians(): void
    {
        $response = $this->getJson('/api/physicians');
        $response->assertStatus(200)
                 ->assertJsonStructure([
                     'data',
                     'status',
                     'code',
                     'message'
                 ]);
    }

    public function test_can_create_Physician(): void
    {
        $data = ['name' => 'Test Physician'];

        $response = $this->postJson('/api/physicians', $data);
        $response->assertStatus(201)
                 ->assertJsonStructure([
                     'data',
                     'status',
                     'code',
                     'message'
                 ]);

        $this->assertDatabaseHas('physicians', $data);
    }

    public function test_can_show_Physician(): void
    {
        $Physician = Physician::factory()->create();

        $response = $this->getJson('/api/physicians/' . $Physician->id);
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

    public function test_can_update_Physician(): void
    {
        $Physician = Physician::factory()->create();
        $data = ['name' => 'Updated Physician'];

        $response = $this->putJson('/api/physicians/' . $Physician->id, $data);
        $response->assertStatus(200)
                 ->assertJsonStructure([
                     'data',
                     'status',
                     'code',
                     'message'
                 ]);

        $this->assertDatabaseHas('physicians', $data);
    }

    public function test_can_delete_Physician(): void
    {
        $Physician = Physician::factory()->create();

        $response = $this->deleteJson('/api/physicians/' . $Physician->id);
        $response->assertStatus(200)
                 ->assertJsonStructure([
                     'status',
                     'code',
                     'message'
                 ]);

        $this->assertDatabaseMissing('physicians', ['id' => $Physician->id]);
    }

    public function test_validation_errors_on_create(): void
    {
        $response = $this->postJson('/api/physicians', []);
        $response->assertStatus(422)
                 ->assertJsonValidationErrors(['name']);
    }
}
