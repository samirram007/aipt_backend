<?php

namespace App\Modules\RoleUser\Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;
use App\Modules\RoleUser\Models\RoleUser;

class RoleUserTest extends TestCase
{
    use RefreshDatabase;

    public function test_can_list_role_users(): void
    {
        $response = $this->getJson('/api/role_users');
        $response->assertStatus(200)
                 ->assertJsonStructure([
                     'data',
                     'status',
                     'code',
                     'message'
                 ]);
    }

    public function test_can_create_RoleUser(): void
    {
        $data = ['name' => 'Test RoleUser'];

        $response = $this->postJson('/api/role_users', $data);
        $response->assertStatus(201)
                 ->assertJsonStructure([
                     'data',
                     'status',
                     'code',
                     'message'
                 ]);

        $this->assertDatabaseHas('role_users', $data);
    }

    public function test_can_show_RoleUser(): void
    {
        $RoleUser = RoleUser::factory()->create();

        $response = $this->getJson('/api/role_users/' . $RoleUser->id);
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

    public function test_can_update_RoleUser(): void
    {
        $RoleUser = RoleUser::factory()->create();
        $data = ['name' => 'Updated RoleUser'];

        $response = $this->putJson('/api/role_users/' . $RoleUser->id, $data);
        $response->assertStatus(200)
                 ->assertJsonStructure([
                     'data',
                     'status',
                     'code',
                     'message'
                 ]);

        $this->assertDatabaseHas('role_users', $data);
    }

    public function test_can_delete_RoleUser(): void
    {
        $RoleUser = RoleUser::factory()->create();

        $response = $this->deleteJson('/api/role_users/' . $RoleUser->id);
        $response->assertStatus(200)
                 ->assertJsonStructure([
                     'status',
                     'code',
                     'message'
                 ]);

        $this->assertDatabaseMissing('role_users', ['id' => $RoleUser->id]);
    }

    public function test_validation_errors_on_create(): void
    {
        $response = $this->postJson('/api/role_users', []);
        $response->assertStatus(422)
                 ->assertJsonValidationErrors(['name']);
    }
}
