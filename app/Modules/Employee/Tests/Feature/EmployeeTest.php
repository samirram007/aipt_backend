<?php

namespace App\Modules\Employee\Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;
use App\Modules\Employee\Models\Employee;

class EmployeeTest extends TestCase
{
    use RefreshDatabase;

    public function test_can_list_employees(): void
    {
        $response = $this->getJson('/api/employees');
        $response->assertStatus(200)
                 ->assertJsonStructure([
                     'data',
                     'status',
                     'code',
                     'message'
                 ]);
    }

    public function test_can_create_Employee(): void
    {
        $data = ['name' => 'Test Employee'];

        $response = $this->postJson('/api/employees', $data);
        $response->assertStatus(201)
                 ->assertJsonStructure([
                     'data',
                     'status',
                     'code',
                     'message'
                 ]);

        $this->assertDatabaseHas('employees', $data);
    }

    public function test_can_show_Employee(): void
    {
        $Employee = Employee::factory()->create();

        $response = $this->getJson('/api/employees/' . $Employee->id);
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

    public function test_can_update_Employee(): void
    {
        $Employee = Employee::factory()->create();
        $data = ['name' => 'Updated Employee'];

        $response = $this->putJson('/api/employees/' . $Employee->id, $data);
        $response->assertStatus(200)
                 ->assertJsonStructure([
                     'data',
                     'status',
                     'code',
                     'message'
                 ]);

        $this->assertDatabaseHas('employees', $data);
    }

    public function test_can_delete_Employee(): void
    {
        $Employee = Employee::factory()->create();

        $response = $this->deleteJson('/api/employees/' . $Employee->id);
        $response->assertStatus(200)
                 ->assertJsonStructure([
                     'status',
                     'code',
                     'message'
                 ]);

        $this->assertDatabaseMissing('employees', ['id' => $Employee->id]);
    }

    public function test_validation_errors_on_create(): void
    {
        $response = $this->postJson('/api/employees', []);
        $response->assertStatus(422)
                 ->assertJsonValidationErrors(['name']);
    }
}
