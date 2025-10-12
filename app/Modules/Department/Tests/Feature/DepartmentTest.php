<?php

namespace App\Modules\Department\Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;
use App\Modules\Department\Models\Department;

class DepartmentTest extends TestCase
{
    use RefreshDatabase;

    public function test_can_list_departments(): void
    {
        $response = $this->getJson('/api/departments');
        $response->assertStatus(200)
                 ->assertJsonStructure([
                     'data',
                     'status',
                     'code',
                     'message'
                 ]);
    }

    public function test_can_create_Department(): void
    {
        $data = ['name' => 'Test Department'];

        $response = $this->postJson('/api/departments', $data);
        $response->assertStatus(201)
                 ->assertJsonStructure([
                     'data',
                     'status',
                     'code',
                     'message'
                 ]);

        $this->assertDatabaseHas('departments', $data);
    }

    public function test_can_show_Department(): void
    {
        $Department = Department::factory()->create();

        $response = $this->getJson('/api/departments/' . $Department->id);
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

    public function test_can_update_Department(): void
    {
        $Department = Department::factory()->create();
        $data = ['name' => 'Updated Department'];

        $response = $this->putJson('/api/departments/' . $Department->id, $data);
        $response->assertStatus(200)
                 ->assertJsonStructure([
                     'data',
                     'status',
                     'code',
                     'message'
                 ]);

        $this->assertDatabaseHas('departments', $data);
    }

    public function test_can_delete_Department(): void
    {
        $Department = Department::factory()->create();

        $response = $this->deleteJson('/api/departments/' . $Department->id);
        $response->assertStatus(200)
                 ->assertJsonStructure([
                     'status',
                     'code',
                     'message'
                 ]);

        $this->assertDatabaseMissing('departments', ['id' => $Department->id]);
    }

    public function test_validation_errors_on_create(): void
    {
        $response = $this->postJson('/api/departments', []);
        $response->assertStatus(422)
                 ->assertJsonValidationErrors(['name']);
    }
}
