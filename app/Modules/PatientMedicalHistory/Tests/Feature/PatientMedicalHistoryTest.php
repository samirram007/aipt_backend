<?php

namespace App\Modules\PatientMedicalHistory\Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;
use App\Modules\PatientMedicalHistory\Models\PatientMedicalHistory;

class PatientMedicalHistoryTest extends TestCase
{
    use RefreshDatabase;

    public function test_can_list_patient_medical_histories(): void
    {
        $response = $this->getJson('/api/patient_medical_histories');
        $response->assertStatus(200)
                 ->assertJsonStructure([
                     'data',
                     'status',
                     'code',
                     'message'
                 ]);
    }

    public function test_can_create_PatientMedicalHistory(): void
    {
        $data = ['name' => 'Test PatientMedicalHistory'];

        $response = $this->postJson('/api/patient_medical_histories', $data);
        $response->assertStatus(201)
                 ->assertJsonStructure([
                     'data',
                     'status',
                     'code',
                     'message'
                 ]);

        $this->assertDatabaseHas('patient_medical_histories', $data);
    }

    public function test_can_show_PatientMedicalHistory(): void
    {
        $PatientMedicalHistory = PatientMedicalHistory::factory()->create();

        $response = $this->getJson('/api/patient_medical_histories/' . $PatientMedicalHistory->id);
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

    public function test_can_update_PatientMedicalHistory(): void
    {
        $PatientMedicalHistory = PatientMedicalHistory::factory()->create();
        $data = ['name' => 'Updated PatientMedicalHistory'];

        $response = $this->putJson('/api/patient_medical_histories/' . $PatientMedicalHistory->id, $data);
        $response->assertStatus(200)
                 ->assertJsonStructure([
                     'data',
                     'status',
                     'code',
                     'message'
                 ]);

        $this->assertDatabaseHas('patient_medical_histories', $data);
    }

    public function test_can_delete_PatientMedicalHistory(): void
    {
        $PatientMedicalHistory = PatientMedicalHistory::factory()->create();

        $response = $this->deleteJson('/api/patient_medical_histories/' . $PatientMedicalHistory->id);
        $response->assertStatus(200)
                 ->assertJsonStructure([
                     'status',
                     'code',
                     'message'
                 ]);

        $this->assertDatabaseMissing('patient_medical_histories', ['id' => $PatientMedicalHistory->id]);
    }

    public function test_validation_errors_on_create(): void
    {
        $response = $this->postJson('/api/patient_medical_histories', []);
        $response->assertStatus(422)
                 ->assertJsonValidationErrors(['name']);
    }
}
