<?php

namespace App\Modules\LeaveType\Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;
use App\Modules\LeaveType\Models\LeaveType;

class LeaveTypeTest extends TestCase
{
    use RefreshDatabase;

    public function test_can_list_leave_types(): void
    {
        $response = $this->getJson('/api/leave_types');
        $response->assertStatus(200)
                 ->assertJsonStructure([
                     'data',
                     'status',
                     'code',
                     'message'
                 ]);
    }

    public function test_can_create_LeaveType(): void
    {
        $data = ['name' => 'Test LeaveType'];

        $response = $this->postJson('/api/leave_types', $data);
        $response->assertStatus(201)
                 ->assertJsonStructure([
                     'data',
                     'status',
                     'code',
                     'message'
                 ]);

        $this->assertDatabaseHas('leave_types', $data);
    }

    public function test_can_show_LeaveType(): void
    {
        $LeaveType = LeaveType::factory()->create();

        $response = $this->getJson('/api/leave_types/' . $LeaveType->id);
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

    public function test_can_update_LeaveType(): void
    {
        $LeaveType = LeaveType::factory()->create();
        $data = ['name' => 'Updated LeaveType'];

        $response = $this->putJson('/api/leave_types/' . $LeaveType->id, $data);
        $response->assertStatus(200)
                 ->assertJsonStructure([
                     'data',
                     'status',
                     'code',
                     'message'
                 ]);

        $this->assertDatabaseHas('leave_types', $data);
    }

    public function test_can_delete_LeaveType(): void
    {
        $LeaveType = LeaveType::factory()->create();

        $response = $this->deleteJson('/api/leave_types/' . $LeaveType->id);
        $response->assertStatus(200)
                 ->assertJsonStructure([
                     'status',
                     'code',
                     'message'
                 ]);

        $this->assertDatabaseMissing('leave_types', ['id' => $LeaveType->id]);
    }

    public function test_validation_errors_on_create(): void
    {
        $response = $this->postJson('/api/leave_types', []);
        $response->assertStatus(422)
                 ->assertJsonValidationErrors(['name']);
    }
}
