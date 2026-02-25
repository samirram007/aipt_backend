<?php

namespace App\Modules\EmployeeGroup\Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;
use App\Modules\EmployeeGroup\Models\EmployeeGroup;

class EmployeeGroupTest extends TestCase
{
    use RefreshDatabase;

    public function test_can_list_employee_groups(): void
    {
        $response = $this->getJson('/api/employee_groups');
        $response->assertStatus(200)
                 ->assertJsonStructure([
                     'data',
                     'status',
                     'code',
                     'message'
                 ]);
    }

    public function test_can_create_EmployeeGroup(): void
    {
        $data = ['name' => 'Test EmployeeGroup'];

        $response = $this->postJson('/api/employee_groups', $data);
        $response->assertStatus(201)
                 ->assertJsonStructure([
                     'data',
                     'status',
                     'code',
                     'message'
                 ]);

        $this->assertDatabaseHas('employee_groups', $data);
    }

    public function test_can_show_EmployeeGroup(): void
    {
        $EmployeeGroup = EmployeeGroup::factory()->create();

        $response = $this->getJson('/api/employee_groups/' . $EmployeeGroup->id);
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

    public function test_can_update_EmployeeGroup(): void
    {
        $EmployeeGroup = EmployeeGroup::factory()->create();
        $data = ['name' => 'Updated EmployeeGroup'];

        $response = $this->putJson('/api/employee_groups/' . $EmployeeGroup->id, $data);
        $response->assertStatus(200)
                 ->assertJsonStructure([
                     'data',
                     'status',
                     'code',
                     'message'
                 ]);

        $this->assertDatabaseHas('employee_groups', $data);
    }

    public function test_can_delete_EmployeeGroup(): void
    {
        $EmployeeGroup = EmployeeGroup::factory()->create();

        $response = $this->deleteJson('/api/employee_groups/' . $EmployeeGroup->id);
        $response->assertStatus(200)
                 ->assertJsonStructure([
                     'status',
                     'code',
                     'message'
                 ]);

        $this->assertDatabaseMissing('employee_groups', ['id' => $EmployeeGroup->id]);
    }

    public function test_validation_errors_on_create(): void
    {
        $response = $this->postJson('/api/employee_groups', []);
        $response->assertStatus(422)
                 ->assertJsonValidationErrors(['name']);
    }
}
