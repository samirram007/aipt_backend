<?php

namespace App\Modules\Role\Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;
use App\Modules\Role\Models\Role;

class RoleTest extends TestCase
{
    use RefreshDatabase;

    public function test_can_list_roles(): void
    {
        $response = $this->getJson('/api/roles');
        $response->assertStatus(200)
                 ->assertJsonStructure([
                     'data',
                     'status',
                     'code',
                     'message'
                 ]);
    }

    public function test_can_create_Role(): void
    {
        $data = ['name' => 'Test Role'];

        $response = $this->postJson('/api/roles', $data);
        $response->assertStatus(201)
                 ->assertJsonStructure([
                     'data',
                     'status',
                     'code',
                     'message'
                 ]);

        $this->assertDatabaseHas('roles', $data);
    }

    public function test_can_show_Role(): void
    {
        $Role = Role::factory()->create();

        $response = $this->getJson('/api/roles/' . $Role->id);
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

    public function test_can_update_Role(): void
    {
        $Role = Role::factory()->create();
        $data = ['name' => 'Updated Role'];

        $response = $this->putJson('/api/roles/' . $Role->id, $data);
        $response->assertStatus(200)
                 ->assertJsonStructure([
                     'data',
                     'status',
                     'code',
                     'message'
                 ]);

        $this->assertDatabaseHas('roles', $data);
    }

    public function test_can_delete_Role(): void
    {
        $Role = Role::factory()->create();

        $response = $this->deleteJson('/api/roles/' . $Role->id);
        $response->assertStatus(200)
                 ->assertJsonStructure([
                     'status',
                     'code',
                     'message'
                 ]);

        $this->assertDatabaseMissing('roles', ['id' => $Role->id]);
    }

    public function test_validation_errors_on_create(): void
    {
        $response = $this->postJson('/api/roles', []);
        $response->assertStatus(422)
                 ->assertJsonValidationErrors(['name']);
    }
}
