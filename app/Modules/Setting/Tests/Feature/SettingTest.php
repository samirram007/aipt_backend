<?php

namespace App\Modules\Setting\Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;
use App\Modules\Setting\Models\Setting;

class SettingTest extends TestCase
{
    use RefreshDatabase;

    public function test_can_list_settings(): void
    {
        $response = $this->getJson('/api/settings');
        $response->assertStatus(200)
                 ->assertJsonStructure([
                     'data',
                     'status',
                     'code',
                     'message'
                 ]);
    }

    public function test_can_create_Setting(): void
    {
        $data = ['name' => 'Test Setting'];

        $response = $this->postJson('/api/settings', $data);
        $response->assertStatus(201)
                 ->assertJsonStructure([
                     'data',
                     'status',
                     'code',
                     'message'
                 ]);

        $this->assertDatabaseHas('settings', $data);
    }

    public function test_can_show_Setting(): void
    {
        $Setting = Setting::factory()->create();

        $response = $this->getJson('/api/settings/' . $Setting->id);
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

    public function test_can_update_Setting(): void
    {
        $Setting = Setting::factory()->create();
        $data = ['name' => 'Updated Setting'];

        $response = $this->putJson('/api/settings/' . $Setting->id, $data);
        $response->assertStatus(200)
                 ->assertJsonStructure([
                     'data',
                     'status',
                     'code',
                     'message'
                 ]);

        $this->assertDatabaseHas('settings', $data);
    }

    public function test_can_delete_Setting(): void
    {
        $Setting = Setting::factory()->create();

        $response = $this->deleteJson('/api/settings/' . $Setting->id);
        $response->assertStatus(200)
                 ->assertJsonStructure([
                     'status',
                     'code',
                     'message'
                 ]);

        $this->assertDatabaseMissing('settings', ['id' => $Setting->id]);
    }

    public function test_validation_errors_on_create(): void
    {
        $response = $this->postJson('/api/settings', []);
        $response->assertStatus(422)
                 ->assertJsonValidationErrors(['name']);
    }
}
