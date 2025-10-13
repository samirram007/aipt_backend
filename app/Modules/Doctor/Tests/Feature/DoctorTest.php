<?php

namespace App\Modules\Doctor\Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;
use App\Modules\Doctor\Models\Doctor;

class DoctorTest extends TestCase
{
    use RefreshDatabase;

    public function test_can_list_doctors(): void
    {
        $response = $this->getJson('/api/doctors');
        $response->assertStatus(200)
                 ->assertJsonStructure([
                     'data',
                     'status',
                     'code',
                     'message'
                 ]);
    }

    public function test_can_create_Doctor(): void
    {
        $data = ['name' => 'Test Doctor'];

        $response = $this->postJson('/api/doctors', $data);
        $response->assertStatus(201)
                 ->assertJsonStructure([
                     'data',
                     'status',
                     'code',
                     'message'
                 ]);

        $this->assertDatabaseHas('doctors', $data);
    }

    public function test_can_show_Doctor(): void
    {
        $Doctor = Doctor::factory()->create();

        $response = $this->getJson('/api/doctors/' . $Doctor->id);
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

    public function test_can_update_Doctor(): void
    {
        $Doctor = Doctor::factory()->create();
        $data = ['name' => 'Updated Doctor'];

        $response = $this->putJson('/api/doctors/' . $Doctor->id, $data);
        $response->assertStatus(200)
                 ->assertJsonStructure([
                     'data',
                     'status',
                     'code',
                     'message'
                 ]);

        $this->assertDatabaseHas('doctors', $data);
    }

    public function test_can_delete_Doctor(): void
    {
        $Doctor = Doctor::factory()->create();

        $response = $this->deleteJson('/api/doctors/' . $Doctor->id);
        $response->assertStatus(200)
                 ->assertJsonStructure([
                     'status',
                     'code',
                     'message'
                 ]);

        $this->assertDatabaseMissing('doctors', ['id' => $Doctor->id]);
    }

    public function test_validation_errors_on_create(): void
    {
        $response = $this->postJson('/api/doctors', []);
        $response->assertStatus(422)
                 ->assertJsonValidationErrors(['name']);
    }
}
