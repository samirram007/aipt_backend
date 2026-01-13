<?php

namespace App\Modules\PatientAllergy\Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;
use App\Modules\PatientAllergy\Models\PatientAllergy;

class PatientAllergyTest extends TestCase
{
    use RefreshDatabase;

    public function test_can_list_patient_allergies(): void
    {
        $response = $this->getJson('/api/patient_allergies');
        $response->assertStatus(200)
                 ->assertJsonStructure([
                     'data',
                     'status',
                     'code',
                     'message'
                 ]);
    }

    public function test_can_create_PatientAllergy(): void
    {
        $data = ['name' => 'Test PatientAllergy'];

        $response = $this->postJson('/api/patient_allergies', $data);
        $response->assertStatus(201)
                 ->assertJsonStructure([
                     'data',
                     'status',
                     'code',
                     'message'
                 ]);

        $this->assertDatabaseHas('patient_allergies', $data);
    }

    public function test_can_show_PatientAllergy(): void
    {
        $PatientAllergy = PatientAllergy::factory()->create();

        $response = $this->getJson('/api/patient_allergies/' . $PatientAllergy->id);
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

    public function test_can_update_PatientAllergy(): void
    {
        $PatientAllergy = PatientAllergy::factory()->create();
        $data = ['name' => 'Updated PatientAllergy'];

        $response = $this->putJson('/api/patient_allergies/' . $PatientAllergy->id, $data);
        $response->assertStatus(200)
                 ->assertJsonStructure([
                     'data',
                     'status',
                     'code',
                     'message'
                 ]);

        $this->assertDatabaseHas('patient_allergies', $data);
    }

    public function test_can_delete_PatientAllergy(): void
    {
        $PatientAllergy = PatientAllergy::factory()->create();

        $response = $this->deleteJson('/api/patient_allergies/' . $PatientAllergy->id);
        $response->assertStatus(200)
                 ->assertJsonStructure([
                     'status',
                     'code',
                     'message'
                 ]);

        $this->assertDatabaseMissing('patient_allergies', ['id' => $PatientAllergy->id]);
    }

    public function test_validation_errors_on_create(): void
    {
        $response = $this->postJson('/api/patient_allergies', []);
        $response->assertStatus(422)
                 ->assertJsonValidationErrors(['name']);
    }
}
