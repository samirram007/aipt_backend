<?php

namespace App\Modules\Patient\Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;
use App\Modules\Patient\Models\Patient;

class PatientTest extends TestCase
{
    use RefreshDatabase;

    public function test_can_list_patients(): void
    {
        $response = $this->getJson('/api/patients');
        $response->assertStatus(200)
                 ->assertJsonStructure([
                     'data',
                     'status',
                     'code',
                     'message'
                 ]);
    }

    public function test_can_create_Patient(): void
    {
        $data = ['name' => 'Test Patient'];

        $response = $this->postJson('/api/patients', $data);
        $response->assertStatus(201)
                 ->assertJsonStructure([
                     'data',
                     'status',
                     'code',
                     'message'
                 ]);

        $this->assertDatabaseHas('patients', $data);
    }

    public function test_can_show_Patient(): void
    {
        $Patient = Patient::factory()->create();

        $response = $this->getJson('/api/patients/' . $Patient->id);
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

    public function test_can_update_Patient(): void
    {
        $Patient = Patient::factory()->create();
        $data = ['name' => 'Updated Patient'];

        $response = $this->putJson('/api/patients/' . $Patient->id, $data);
        $response->assertStatus(200)
                 ->assertJsonStructure([
                     'data',
                     'status',
                     'code',
                     'message'
                 ]);

        $this->assertDatabaseHas('patients', $data);
    }

    public function test_can_delete_Patient(): void
    {
        $Patient = Patient::factory()->create();

        $response = $this->deleteJson('/api/patients/' . $Patient->id);
        $response->assertStatus(200)
                 ->assertJsonStructure([
                     'status',
                     'code',
                     'message'
                 ]);

        $this->assertDatabaseMissing('patients', ['id' => $Patient->id]);
    }

    public function test_validation_errors_on_create(): void
    {
        $response = $this->postJson('/api/patients', []);
        $response->assertStatus(422)
                 ->assertJsonValidationErrors(['name']);
    }
}
