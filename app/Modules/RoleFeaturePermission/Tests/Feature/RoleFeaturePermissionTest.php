<?php

namespace App\Modules\RoleFeaturePermission\Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;
use App\Modules\RoleFeaturePermission\Models\RoleFeaturePermission;

class RoleFeaturePermissionTest extends TestCase
{
    use RefreshDatabase;

    public function test_can_list_role_feature_permissions(): void
    {
        $response = $this->getJson('/api/role_feature_permissions');
        $response->assertStatus(200)
                 ->assertJsonStructure([
                     'data',
                     'status',
                     'code',
                     'message'
                 ]);
    }

    public function test_can_create_RoleFeaturePermission(): void
    {
        $data = ['name' => 'Test RoleFeaturePermission'];

        $response = $this->postJson('/api/role_feature_permissions', $data);
        $response->assertStatus(201)
                 ->assertJsonStructure([
                     'data',
                     'status',
                     'code',
                     'message'
                 ]);

        $this->assertDatabaseHas('role_feature_permissions', $data);
    }

    public function test_can_show_RoleFeaturePermission(): void
    {
        $RoleFeaturePermission = RoleFeaturePermission::factory()->create();

        $response = $this->getJson('/api/role_feature_permissions/' . $RoleFeaturePermission->id);
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

    public function test_can_update_RoleFeaturePermission(): void
    {
        $RoleFeaturePermission = RoleFeaturePermission::factory()->create();
        $data = ['name' => 'Updated RoleFeaturePermission'];

        $response = $this->putJson('/api/role_feature_permissions/' . $RoleFeaturePermission->id, $data);
        $response->assertStatus(200)
                 ->assertJsonStructure([
                     'data',
                     'status',
                     'code',
                     'message'
                 ]);

        $this->assertDatabaseHas('role_feature_permissions', $data);
    }

    public function test_can_delete_RoleFeaturePermission(): void
    {
        $RoleFeaturePermission = RoleFeaturePermission::factory()->create();

        $response = $this->deleteJson('/api/role_feature_permissions/' . $RoleFeaturePermission->id);
        $response->assertStatus(200)
                 ->assertJsonStructure([
                     'status',
                     'code',
                     'message'
                 ]);

        $this->assertDatabaseMissing('role_feature_permissions', ['id' => $RoleFeaturePermission->id]);
    }

    public function test_validation_errors_on_create(): void
    {
        $response = $this->postJson('/api/role_feature_permissions', []);
        $response->assertStatus(422)
                 ->assertJsonValidationErrors(['name']);
    }
}
