<?php

namespace App\Modules\Module\Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;
use App\Modules\Module\Models\Module;

class ModuleTest extends TestCase
{
    use RefreshDatabase;

    public function test_can_list_modules(): void
    {
        $response = $this->getJson('/api/modules');
        $response->assertStatus(200)
                 ->assertJsonStructure([
                     'data',
                     'status',
                     'code',
                     'message'
                 ]);
    }

    public function test_can_create_Module(): void
    {
        $data = ['name' => 'Test Module'];

        $response = $this->postJson('/api/modules', $data);
        $response->assertStatus(201)
                 ->assertJsonStructure([
                     'data',
                     'status',
                     'code',
                     'message'
                 ]);

        $this->assertDatabaseHas('modules', $data);
    }

    public function test_can_show_Module(): void
    {
        $Module = Module::factory()->create();

        $response = $this->getJson('/api/modules/' . $Module->id);
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

    public function test_can_update_Module(): void
    {
        $Module = Module::factory()->create();
        $data = ['name' => 'Updated Module'];

        $response = $this->putJson('/api/modules/' . $Module->id, $data);
        $response->assertStatus(200)
                 ->assertJsonStructure([
                     'data',
                     'status',
                     'code',
                     'message'
                 ]);

        $this->assertDatabaseHas('modules', $data);
    }

    public function test_can_delete_Module(): void
    {
        $Module = Module::factory()->create();

        $response = $this->deleteJson('/api/modules/' . $Module->id);
        $response->assertStatus(200)
                 ->assertJsonStructure([
                     'status',
                     'code',
                     'message'
                 ]);

        $this->assertDatabaseMissing('modules', ['id' => $Module->id]);
    }

    public function test_validation_errors_on_create(): void
    {
        $response = $this->postJson('/api/modules', []);
        $response->assertStatus(422)
                 ->assertJsonValidationErrors(['name']);
    }
}
