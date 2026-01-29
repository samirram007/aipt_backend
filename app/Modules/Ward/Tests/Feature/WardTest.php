<?php

namespace App\Modules\Ward\Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;
use App\Modules\Ward\Models\Ward;

class WardTest extends TestCase
{
    use RefreshDatabase;

    public function test_can_list_wards(): void
    {
        $response = $this->getJson('/api/wards');
        $response->assertStatus(200)
                 ->assertJsonStructure([
                     'data',
                     'status',
                     'code',
                     'message'
                 ]);
    }

    public function test_can_create_Ward(): void
    {
        $data = ['name' => 'Test Ward'];

        $response = $this->postJson('/api/wards', $data);
        $response->assertStatus(201)
                 ->assertJsonStructure([
                     'data',
                     'status',
                     'code',
                     'message'
                 ]);

        $this->assertDatabaseHas('wards', $data);
    }

    public function test_can_show_Ward(): void
    {
        $Ward = Ward::factory()->create();

        $response = $this->getJson('/api/wards/' . $Ward->id);
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

    public function test_can_update_Ward(): void
    {
        $Ward = Ward::factory()->create();
        $data = ['name' => 'Updated Ward'];

        $response = $this->putJson('/api/wards/' . $Ward->id, $data);
        $response->assertStatus(200)
                 ->assertJsonStructure([
                     'data',
                     'status',
                     'code',
                     'message'
                 ]);

        $this->assertDatabaseHas('wards', $data);
    }

    public function test_can_delete_Ward(): void
    {
        $Ward = Ward::factory()->create();

        $response = $this->deleteJson('/api/wards/' . $Ward->id);
        $response->assertStatus(200)
                 ->assertJsonStructure([
                     'status',
                     'code',
                     'message'
                 ]);

        $this->assertDatabaseMissing('wards', ['id' => $Ward->id]);
    }

    public function test_validation_errors_on_create(): void
    {
        $response = $this->postJson('/api/wards', []);
        $response->assertStatus(422)
                 ->assertJsonValidationErrors(['name']);
    }
}
