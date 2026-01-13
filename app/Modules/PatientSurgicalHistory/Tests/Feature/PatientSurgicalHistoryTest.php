<?php

namespace App\Modules\PatientSurgicalHistory\Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;
use App\Modules\PatientSurgicalHistory\Models\PatientSurgicalHistory;

class PatientSurgicalHistoryTest extends TestCase
{
    use RefreshDatabase;

    public function test_can_list_patient_surgical_histories(): void
    {
        $response = $this->getJson('/api/patient_surgical_histories');
        $response->assertStatus(200)
                 ->assertJsonStructure([
                     'data',
                     'status',
                     'code',
                     'message'
                 ]);
    }

    public function test_can_create_PatientSurgicalHistory(): void
    {
        $data = ['name' => 'Test PatientSurgicalHistory'];

        $response = $this->postJson('/api/patient_surgical_histories', $data);
        $response->assertStatus(201)
                 ->assertJsonStructure([
                     'data',
                     'status',
                     'code',
                     'message'
                 ]);

        $this->assertDatabaseHas('patient_surgical_histories', $data);
    }

    public function test_can_show_PatientSurgicalHistory(): void
    {
        $PatientSurgicalHistory = PatientSurgicalHistory::factory()->create();

        $response = $this->getJson('/api/patient_surgical_histories/' . $PatientSurgicalHistory->id);
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

    public function test_can_update_PatientSurgicalHistory(): void
    {
        $PatientSurgicalHistory = PatientSurgicalHistory::factory()->create();
        $data = ['name' => 'Updated PatientSurgicalHistory'];

        $response = $this->putJson('/api/patient_surgical_histories/' . $PatientSurgicalHistory->id, $data);
        $response->assertStatus(200)
                 ->assertJsonStructure([
                     'data',
                     'status',
                     'code',
                     'message'
                 ]);

        $this->assertDatabaseHas('patient_surgical_histories', $data);
    }

    public function test_can_delete_PatientSurgicalHistory(): void
    {
        $PatientSurgicalHistory = PatientSurgicalHistory::factory()->create();

        $response = $this->deleteJson('/api/patient_surgical_histories/' . $PatientSurgicalHistory->id);
        $response->assertStatus(200)
                 ->assertJsonStructure([
                     'status',
                     'code',
                     'message'
                 ]);

        $this->assertDatabaseMissing('patient_surgical_histories', ['id' => $PatientSurgicalHistory->id]);
    }

    public function test_validation_errors_on_create(): void
    {
        $response = $this->postJson('/api/patient_surgical_histories', []);
        $response->assertStatus(422)
                 ->assertJsonValidationErrors(['name']);
    }
}
