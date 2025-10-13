<?php

namespace App\Modules\AppModule\Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;
use App\Modules\AppModule\Models\AppModule;

class AppModuleTest extends TestCase
{
    use RefreshDatabase;

    public function test_can_list_app_modules(): void
    {
        $response = $this->getJson('/api/app_modules');
        $response->assertStatus(200)
                 ->assertJsonStructure([
                     'data',
                     'status',
                     'code',
                     'message'
                 ]);
    }

    public function test_can_create_AppModule(): void
    {
        $data = ['name' => 'Test AppModule'];

        $response = $this->postJson('/api/app_modules', $data);
        $response->assertStatus(201)
                 ->assertJsonStructure([
                     'data',
                     'status',
                     'code',
                     'message'
                 ]);

        $this->assertDatabaseHas('app_modules', $data);
    }

    public function test_can_show_AppModule(): void
    {
        $AppModule = AppModule::factory()->create();

        $response = $this->getJson('/api/app_modules/' . $AppModule->id);
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

    public function test_can_update_AppModule(): void
    {
        $AppModule = AppModule::factory()->create();
        $data = ['name' => 'Updated AppModule'];

        $response = $this->putJson('/api/app_modules/' . $AppModule->id, $data);
        $response->assertStatus(200)
                 ->assertJsonStructure([
                     'data',
                     'status',
                     'code',
                     'message'
                 ]);

        $this->assertDatabaseHas('app_modules', $data);
    }

    public function test_can_delete_AppModule(): void
    {
        $AppModule = AppModule::factory()->create();

        $response = $this->deleteJson('/api/app_modules/' . $AppModule->id);
        $response->assertStatus(200)
                 ->assertJsonStructure([
                     'status',
                     'code',
                     'message'
                 ]);

        $this->assertDatabaseMissing('app_modules', ['id' => $AppModule->id]);
    }

    public function test_validation_errors_on_create(): void
    {
        $response = $this->postJson('/api/app_modules', []);
        $response->assertStatus(422)
                 ->assertJsonValidationErrors(['name']);
    }
}
