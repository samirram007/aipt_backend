<?php

namespace App\Modules\AppModuleFeature\Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;
use App\Modules\AppModuleFeature\Models\AppModuleFeature;

class AppModuleFeatureTest extends TestCase
{
    use RefreshDatabase;

    public function test_can_list_app_module_features(): void
    {
        $response = $this->getJson('/api/app_module_features');
        $response->assertStatus(200)
                 ->assertJsonStructure([
                     'data',
                     'status',
                     'code',
                     'message'
                 ]);
    }

    public function test_can_create_AppModuleFeature(): void
    {
        $data = ['name' => 'Test AppModuleFeature'];

        $response = $this->postJson('/api/app_module_features', $data);
        $response->assertStatus(201)
                 ->assertJsonStructure([
                     'data',
                     'status',
                     'code',
                     'message'
                 ]);

        $this->assertDatabaseHas('app_module_features', $data);
    }

    public function test_can_show_AppModuleFeature(): void
    {
        $AppModuleFeature = AppModuleFeature::factory()->create();

        $response = $this->getJson('/api/app_module_features/' . $AppModuleFeature->id);
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

    public function test_can_update_AppModuleFeature(): void
    {
        $AppModuleFeature = AppModuleFeature::factory()->create();
        $data = ['name' => 'Updated AppModuleFeature'];

        $response = $this->putJson('/api/app_module_features/' . $AppModuleFeature->id, $data);
        $response->assertStatus(200)
                 ->assertJsonStructure([
                     'data',
                     'status',
                     'code',
                     'message'
                 ]);

        $this->assertDatabaseHas('app_module_features', $data);
    }

    public function test_can_delete_AppModuleFeature(): void
    {
        $AppModuleFeature = AppModuleFeature::factory()->create();

        $response = $this->deleteJson('/api/app_module_features/' . $AppModuleFeature->id);
        $response->assertStatus(200)
                 ->assertJsonStructure([
                     'status',
                     'code',
                     'message'
                 ]);

        $this->assertDatabaseMissing('app_module_features', ['id' => $AppModuleFeature->id]);
    }

    public function test_validation_errors_on_create(): void
    {
        $response = $this->postJson('/api/app_module_features', []);
        $response->assertStatus(422)
                 ->assertJsonValidationErrors(['name']);
    }
}
