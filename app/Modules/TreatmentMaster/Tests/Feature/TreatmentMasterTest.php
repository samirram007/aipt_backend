<?php

namespace App\Modules\TreatmentMaster\Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;
use App\Modules\TreatmentMaster\Models\TreatmentMaster;

class TreatmentMasterTest extends TestCase
{
    use RefreshDatabase;

    public function test_can_list_treatment_masters(): void
    {
        $response = $this->getJson('/api/treatment_masters');
        $response->assertStatus(200)
                 ->assertJsonStructure([
                     'data',
                     'status',
                     'code',
                     'message'
                 ]);
    }

    public function test_can_create_TreatmentMaster(): void
    {
        $data = ['name' => 'Test TreatmentMaster'];

        $response = $this->postJson('/api/treatment_masters', $data);
        $response->assertStatus(201)
                 ->assertJsonStructure([
                     'data',
                     'status',
                     'code',
                     'message'
                 ]);

        $this->assertDatabaseHas('treatment_masters', $data);
    }

    public function test_can_show_TreatmentMaster(): void
    {
        $TreatmentMaster = TreatmentMaster::factory()->create();

        $response = $this->getJson('/api/treatment_masters/' . $TreatmentMaster->id);
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

    public function test_can_update_TreatmentMaster(): void
    {
        $TreatmentMaster = TreatmentMaster::factory()->create();
        $data = ['name' => 'Updated TreatmentMaster'];

        $response = $this->putJson('/api/treatment_masters/' . $TreatmentMaster->id, $data);
        $response->assertStatus(200)
                 ->assertJsonStructure([
                     'data',
                     'status',
                     'code',
                     'message'
                 ]);

        $this->assertDatabaseHas('treatment_masters', $data);
    }

    public function test_can_delete_TreatmentMaster(): void
    {
        $TreatmentMaster = TreatmentMaster::factory()->create();

        $response = $this->deleteJson('/api/treatment_masters/' . $TreatmentMaster->id);
        $response->assertStatus(200)
                 ->assertJsonStructure([
                     'status',
                     'code',
                     'message'
                 ]);

        $this->assertDatabaseMissing('treatment_masters', ['id' => $TreatmentMaster->id]);
    }

    public function test_validation_errors_on_create(): void
    {
        $response = $this->postJson('/api/treatment_masters', []);
        $response->assertStatus(422)
                 ->assertJsonValidationErrors(['name']);
    }
}
