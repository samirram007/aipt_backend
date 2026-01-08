<?php

namespace App\Modules\PatientTreatment\Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;
use App\Modules\PatientTreatment\Models\PatientTreatment;

class PatientTreatmentTest extends TestCase
{
    use RefreshDatabase;

    public function test_can_list_patient_treatments(): void
    {
        $response = $this->getJson('/api/patient_treatments');
        $response->assertStatus(200)
                 ->assertJsonStructure([
                     'data',
                     'status',
                     'code',
                     'message'
                 ]);
    }

    public function test_can_create_PatientTreatment(): void
    {
        $data = ['name' => 'Test PatientTreatment'];

        $response = $this->postJson('/api/patient_treatments', $data);
        $response->assertStatus(201)
                 ->assertJsonStructure([
                     'data',
                     'status',
                     'code',
                     'message'
                 ]);

        $this->assertDatabaseHas('patient_treatments', $data);
    }

    public function test_can_show_PatientTreatment(): void
    {
        $PatientTreatment = PatientTreatment::factory()->create();

        $response = $this->getJson('/api/patient_treatments/' . $PatientTreatment->id);
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

    public function test_can_update_PatientTreatment(): void
    {
        $PatientTreatment = PatientTreatment::factory()->create();
        $data = ['name' => 'Updated PatientTreatment'];

        $response = $this->putJson('/api/patient_treatments/' . $PatientTreatment->id, $data);
        $response->assertStatus(200)
                 ->assertJsonStructure([
                     'data',
                     'status',
                     'code',
                     'message'
                 ]);

        $this->assertDatabaseHas('patient_treatments', $data);
    }

    public function test_can_delete_PatientTreatment(): void
    {
        $PatientTreatment = PatientTreatment::factory()->create();

        $response = $this->deleteJson('/api/patient_treatments/' . $PatientTreatment->id);
        $response->assertStatus(200)
                 ->assertJsonStructure([
                     'status',
                     'code',
                     'message'
                 ]);

        $this->assertDatabaseMissing('patient_treatments', ['id' => $PatientTreatment->id]);
    }

    public function test_validation_errors_on_create(): void
    {
        $response = $this->postJson('/api/patient_treatments', []);
        $response->assertStatus(422)
                 ->assertJsonValidationErrors(['name']);
    }
}
