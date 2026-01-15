<?php

namespace App\Modules\Facility\Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;
use App\Modules\Facility\Models\Facility;

class FacilityTest extends TestCase
{
    use RefreshDatabase;

    public function test_can_list_facilities(): void
    {
        $response = $this->getJson('/api/facilities');
        $response->assertStatus(200)
                 ->assertJsonStructure([
                     'data',
                     'status',
                     'code',
                     'message'
                 ]);
    }

    public function test_can_create_Facility(): void
    {
        $data = ['name' => 'Test Facility'];

        $response = $this->postJson('/api/facilities', $data);
        $response->assertStatus(201)
                 ->assertJsonStructure([
                     'data',
                     'status',
                     'code',
                     'message'
                 ]);

        $this->assertDatabaseHas('facilities', $data);
    }

    public function test_can_show_Facility(): void
    {
        $Facility = Facility::factory()->create();

        $response = $this->getJson('/api/facilities/' . $Facility->id);
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

    public function test_can_update_Facility(): void
    {
        $Facility = Facility::factory()->create();
        $data = ['name' => 'Updated Facility'];

        $response = $this->putJson('/api/facilities/' . $Facility->id, $data);
        $response->assertStatus(200)
                 ->assertJsonStructure([
                     'data',
                     'status',
                     'code',
                     'message'
                 ]);

        $this->assertDatabaseHas('facilities', $data);
    }

    public function test_can_delete_Facility(): void
    {
        $Facility = Facility::factory()->create();

        $response = $this->deleteJson('/api/facilities/' . $Facility->id);
        $response->assertStatus(200)
                 ->assertJsonStructure([
                     'status',
                     'code',
                     'message'
                 ]);

        $this->assertDatabaseMissing('facilities', ['id' => $Facility->id]);
    }

    public function test_validation_errors_on_create(): void
    {
        $response = $this->postJson('/api/facilities', []);
        $response->assertStatus(422)
                 ->assertJsonValidationErrors(['name']);
    }
}
