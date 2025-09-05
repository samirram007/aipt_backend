<?php

namespace App\Modules\Auth\Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;
use App\Modules\Auth\Models\Auth;

class AuthTest extends TestCase
{
    use RefreshDatabase;

    public function test_can_list_auths(): void
    {
        $response = $this->getJson('/api/auths');
        $response->assertStatus(200)
                 ->assertJsonStructure([
                     'data',
                     'status',
                     'code',
                     'message'
                 ]);
    }

    public function test_can_create_Auth(): void
    {
        $data = ['name' => 'Test Auth'];

        $response = $this->postJson('/api/auths', $data);
        $response->assertStatus(201)
                 ->assertJsonStructure([
                     'data',
                     'status',
                     'code',
                     'message'
                 ]);

        $this->assertDatabaseHas('auths', $data);
    }

    public function test_can_show_Auth(): void
    {
        $Auth = Auth::factory()->create();

        $response = $this->getJson('/api/auths/' . $Auth->id);
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

    public function test_can_update_Auth(): void
    {
        $Auth = Auth::factory()->create();
        $data = ['name' => 'Updated Auth'];

        $response = $this->putJson('/api/auths/' . $Auth->id, $data);
        $response->assertStatus(200)
                 ->assertJsonStructure([
                     'data',
                     'status',
                     'code',
                     'message'
                 ]);

        $this->assertDatabaseHas('auths', $data);
    }

    public function test_can_delete_Auth(): void
    {
        $Auth = Auth::factory()->create();

        $response = $this->deleteJson('/api/auths/' . $Auth->id);
        $response->assertStatus(200)
                 ->assertJsonStructure([
                     'status',
                     'code',
                     'message'
                 ]);

        $this->assertDatabaseMissing('auths', ['id' => $Auth->id]);
    }

    public function test_validation_errors_on_create(): void
    {
        $response = $this->postJson('/api/auths', []);
        $response->assertStatus(422)
                 ->assertJsonValidationErrors(['name']);
    }
}
