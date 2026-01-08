<?php

namespace App\Modules\PatientTreatmentDetail\Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;
use App\Modules\PatientTreatmentDetail\Models\PatientTreatmentDetail;

class PatientTreatmentDetailTest extends TestCase
{
    use RefreshDatabase;

    public function test_can_list_patient_treatment_details(): void
    {
        $response = $this->getJson('/api/patient_treatment_details');
        $response->assertStatus(200)
                 ->assertJsonStructure([
                     'data',
                     'status',
                     'code',
                     'message'
                 ]);
    }

    public function test_can_create_PatientTreatmentDetail(): void
    {
        $data = ['name' => 'Test PatientTreatmentDetail'];

        $response = $this->postJson('/api/patient_treatment_details', $data);
        $response->assertStatus(201)
                 ->assertJsonStructure([
                     'data',
                     'status',
                     'code',
                     'message'
                 ]);

        $this->assertDatabaseHas('patient_treatment_details', $data);
    }

    public function test_can_show_PatientTreatmentDetail(): void
    {
        $PatientTreatmentDetail = PatientTreatmentDetail::factory()->create();

        $response = $this->getJson('/api/patient_treatment_details/' . $PatientTreatmentDetail->id);
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

    public function test_can_update_PatientTreatmentDetail(): void
    {
        $PatientTreatmentDetail = PatientTreatmentDetail::factory()->create();
        $data = ['name' => 'Updated PatientTreatmentDetail'];

        $response = $this->putJson('/api/patient_treatment_details/' . $PatientTreatmentDetail->id, $data);
        $response->assertStatus(200)
                 ->assertJsonStructure([
                     'data',
                     'status',
                     'code',
                     'message'
                 ]);

        $this->assertDatabaseHas('patient_treatment_details', $data);
    }

    public function test_can_delete_PatientTreatmentDetail(): void
    {
        $PatientTreatmentDetail = PatientTreatmentDetail::factory()->create();

        $response = $this->deleteJson('/api/patient_treatment_details/' . $PatientTreatmentDetail->id);
        $response->assertStatus(200)
                 ->assertJsonStructure([
                     'status',
                     'code',
                     'message'
                 ]);

        $this->assertDatabaseMissing('patient_treatment_details', ['id' => $PatientTreatmentDetail->id]);
    }

    public function test_validation_errors_on_create(): void
    {
        $response = $this->postJson('/api/patient_treatment_details', []);
        $response->assertStatus(422)
                 ->assertJsonValidationErrors(['name']);
    }
}
