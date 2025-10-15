<?php

namespace App\Modules\RolePermission\Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;
use App\Modules\RolePermission\Models\RolePermission;

class RolePermissionTest extends TestCase
{
    use RefreshDatabase;

    public function test_can_list_role_permissions(): void
    {
        $response = $this->getJson('/api/role_permissions');
        $response->assertStatus(200)
                 ->assertJsonStructure([
                     'data',
                     'status',
                     'code',
                     'message'
                 ]);
    }

    public function test_can_create_RolePermission(): void
    {
        $data = ['name' => 'Test RolePermission'];

        $response = $this->postJson('/api/role_permissions', $data);
        $response->assertStatus(201)
                 ->assertJsonStructure([
                     'data',
                     'status',
                     'code',
                     'message'
                 ]);

        $this->assertDatabaseHas('role_permissions', $data);
    }

    public function test_can_show_RolePermission(): void
    {
        $RolePermission = RolePermission::factory()->create();

        $response = $this->getJson('/api/role_permissions/' . $RolePermission->id);
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

    public function test_can_update_RolePermission(): void
    {
        $RolePermission = RolePermission::factory()->create();
        $data = ['name' => 'Updated RolePermission'];

        $response = $this->putJson('/api/role_permissions/' . $RolePermission->id, $data);
        $response->assertStatus(200)
                 ->assertJsonStructure([
                     'data',
                     'status',
                     'code',
                     'message'
                 ]);

        $this->assertDatabaseHas('role_permissions', $data);
    }

    public function test_can_delete_RolePermission(): void
    {
        $RolePermission = RolePermission::factory()->create();

        $response = $this->deleteJson('/api/role_permissions/' . $RolePermission->id);
        $response->assertStatus(200)
                 ->assertJsonStructure([
                     'status',
                     'code',
                     'message'
                 ]);

        $this->assertDatabaseMissing('role_permissions', ['id' => $RolePermission->id]);
    }

    public function test_validation_errors_on_create(): void
    {
        $response = $this->postJson('/api/role_permissions', []);
        $response->assertStatus(422)
                 ->assertJsonValidationErrors(['name']);
    }
}
