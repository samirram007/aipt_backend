<?php

namespace App\Modules\PatientVital\Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;
use App\Modules\PatientVital\Models\PatientVital;

class PatientVitalTest extends TestCase
{
    use RefreshDatabase;

    public function test_can_list_patient_vitals(): void
    {
        $response = $this->getJson('/api/patient_vitals');
        $response->assertStatus(200)
                 ->assertJsonStructure([
                     'data',
                     'status',
                     'code',
                     'message'
                 ]);
    }

    public function test_can_create_PatientVital(): void
    {
        $data = ['name' => 'Test PatientVital'];

        $response = $this->postJson('/api/patient_vitals', $data);
        $response->assertStatus(201)
                 ->assertJsonStructure([
                     'data',
                     'status',
                     'code',
                     'message'
                 ]);

        $this->assertDatabaseHas('patient_vitals', $data);
    }

    public function test_can_show_PatientVital(): void
    {
        $PatientVital = PatientVital::factory()->create();

        $response = $this->getJson('/api/patient_vitals/' . $PatientVital->id);
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

    public function test_can_update_PatientVital(): void
    {
        $PatientVital = PatientVital::factory()->create();
        $data = ['name' => 'Updated PatientVital'];

        $response = $this->putJson('/api/patient_vitals/' . $PatientVital->id, $data);
        $response->assertStatus(200)
                 ->assertJsonStructure([
                     'data',
                     'status',
                     'code',
                     'message'
                 ]);

        $this->assertDatabaseHas('patient_vitals', $data);
    }

    public function test_can_delete_PatientVital(): void
    {
        $PatientVital = PatientVital::factory()->create();

        $response = $this->deleteJson('/api/patient_vitals/' . $PatientVital->id);
        $response->assertStatus(200)
                 ->assertJsonStructure([
                     'status',
                     'code',
                     'message'
                 ]);

        $this->assertDatabaseMissing('patient_vitals', ['id' => $PatientVital->id]);
    }

    public function test_validation_errors_on_create(): void
    {
        $response = $this->postJson('/api/patient_vitals', []);
        $response->assertStatus(422)
                 ->assertJsonValidationErrors(['name']);
    }
}
