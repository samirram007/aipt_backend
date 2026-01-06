<?php

namespace App\Modules\PatientSession\Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;
use App\Modules\PatientSession\Models\PatientSession;

class PatientSessionTest extends TestCase
{
    use RefreshDatabase;

    public function test_can_list_patient_sessions(): void
    {
        $response = $this->getJson('/api/patient_sessions');
        $response->assertStatus(200)
                 ->assertJsonStructure([
                     'data',
                     'status',
                     'code',
                     'message'
                 ]);
    }

    public function test_can_create_PatientSession(): void
    {
        $data = ['name' => 'Test PatientSession'];

        $response = $this->postJson('/api/patient_sessions', $data);
        $response->assertStatus(201)
                 ->assertJsonStructure([
                     'data',
                     'status',
                     'code',
                     'message'
                 ]);

        $this->assertDatabaseHas('patient_sessions', $data);
    }

    public function test_can_show_PatientSession(): void
    {
        $PatientSession = PatientSession::factory()->create();

        $response = $this->getJson('/api/patient_sessions/' . $PatientSession->id);
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

    public function test_can_update_PatientSession(): void
    {
        $PatientSession = PatientSession::factory()->create();
        $data = ['name' => 'Updated PatientSession'];

        $response = $this->putJson('/api/patient_sessions/' . $PatientSession->id, $data);
        $response->assertStatus(200)
                 ->assertJsonStructure([
                     'data',
                     'status',
                     'code',
                     'message'
                 ]);

        $this->assertDatabaseHas('patient_sessions', $data);
    }

    public function test_can_delete_PatientSession(): void
    {
        $PatientSession = PatientSession::factory()->create();

        $response = $this->deleteJson('/api/patient_sessions/' . $PatientSession->id);
        $response->assertStatus(200)
                 ->assertJsonStructure([
                     'status',
                     'code',
                     'message'
                 ]);

        $this->assertDatabaseMissing('patient_sessions', ['id' => $PatientSession->id]);
    }

    public function test_validation_errors_on_create(): void
    {
        $response = $this->postJson('/api/patient_sessions', []);
        $response->assertStatus(422)
                 ->assertJsonValidationErrors(['name']);
    }
}
