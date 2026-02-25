<?php

namespace App\Modules\HsnSacCode\Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;
use App\Modules\HsnSacCode\Models\HsnSacCode;

class HsnSacCodeTest extends TestCase
{
    use RefreshDatabase;

    public function test_can_list_hsn_sac_codes(): void
    {
        $response = $this->getJson('/api/hsn_sac_codes');
        $response->assertStatus(200)
                 ->assertJsonStructure([
                     'data',
                     'status',
                     'code',
                     'message'
                 ]);
    }

    public function test_can_create_HsnSacCode(): void
    {
        $data = ['name' => 'Test HsnSacCode'];

        $response = $this->postJson('/api/hsn_sac_codes', $data);
        $response->assertStatus(201)
                 ->assertJsonStructure([
                     'data',
                     'status',
                     'code',
                     'message'
                 ]);

        $this->assertDatabaseHas('hsn_sac_codes', $data);
    }

    public function test_can_show_HsnSacCode(): void
    {
        $HsnSacCode = HsnSacCode::factory()->create();

        $response = $this->getJson('/api/hsn_sac_codes/' . $HsnSacCode->id);
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

    public function test_can_update_HsnSacCode(): void
    {
        $HsnSacCode = HsnSacCode::factory()->create();
        $data = ['name' => 'Updated HsnSacCode'];

        $response = $this->putJson('/api/hsn_sac_codes/' . $HsnSacCode->id, $data);
        $response->assertStatus(200)
                 ->assertJsonStructure([
                     'data',
                     'status',
                     'code',
                     'message'
                 ]);

        $this->assertDatabaseHas('hsn_sac_codes', $data);
    }

    public function test_can_delete_HsnSacCode(): void
    {
        $HsnSacCode = HsnSacCode::factory()->create();

        $response = $this->deleteJson('/api/hsn_sac_codes/' . $HsnSacCode->id);
        $response->assertStatus(200)
                 ->assertJsonStructure([
                     'status',
                     'code',
                     'message'
                 ]);

        $this->assertDatabaseMissing('hsn_sac_codes', ['id' => $HsnSacCode->id]);
    }

    public function test_validation_errors_on_create(): void
    {
        $response = $this->postJson('/api/hsn_sac_codes', []);
        $response->assertStatus(422)
                 ->assertJsonValidationErrors(['name']);
    }
}
