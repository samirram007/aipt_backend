<?php

namespace App\Modules\UniqueQuantityCode\Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;
use App\Modules\UniqueQuantityCode\Models\UniqueQuantityCode;

class UniqueQuantityCodeTest extends TestCase
{
    use RefreshDatabase;

    public function test_can_list_unique_quantity_codes(): void
    {
        $response = $this->getJson('/api/unique_quantity_codes');
        $response->assertStatus(200)
                 ->assertJsonStructure([
                     'data',
                     'status',
                     'code',
                     'message'
                 ]);
    }

    public function test_can_create_UniqueQuantityCode(): void
    {
        $data = ['name' => 'Test UniqueQuantityCode'];

        $response = $this->postJson('/api/unique_quantity_codes', $data);
        $response->assertStatus(201)
                 ->assertJsonStructure([
                     'data',
                     'status',
                     'code',
                     'message'
                 ]);

        $this->assertDatabaseHas('unique_quantity_codes', $data);
    }

    public function test_can_show_UniqueQuantityCode(): void
    {
        $UniqueQuantityCode = UniqueQuantityCode::factory()->create();

        $response = $this->getJson('/api/unique_quantity_codes/' . $UniqueQuantityCode->id);
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

    public function test_can_update_UniqueQuantityCode(): void
    {
        $UniqueQuantityCode = UniqueQuantityCode::factory()->create();
        $data = ['name' => 'Updated UniqueQuantityCode'];

        $response = $this->putJson('/api/unique_quantity_codes/' . $UniqueQuantityCode->id, $data);
        $response->assertStatus(200)
                 ->assertJsonStructure([
                     'data',
                     'status',
                     'code',
                     'message'
                 ]);

        $this->assertDatabaseHas('unique_quantity_codes', $data);
    }

    public function test_can_delete_UniqueQuantityCode(): void
    {
        $UniqueQuantityCode = UniqueQuantityCode::factory()->create();

        $response = $this->deleteJson('/api/unique_quantity_codes/' . $UniqueQuantityCode->id);
        $response->assertStatus(200)
                 ->assertJsonStructure([
                     'status',
                     'code',
                     'message'
                 ]);

        $this->assertDatabaseMissing('unique_quantity_codes', ['id' => $UniqueQuantityCode->id]);
    }

    public function test_validation_errors_on_create(): void
    {
        $response = $this->postJson('/api/unique_quantity_codes', []);
        $response->assertStatus(422)
                 ->assertJsonValidationErrors(['name']);
    }
}
