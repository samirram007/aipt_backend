<?php

namespace App\Modules\StorageUnit\Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;
use App\Modules\StorageUnit\Models\StorageUnit;

class StorageUnitTest extends TestCase
{
    use RefreshDatabase;

    public function test_can_list_storage_units(): void
    {
        $response = $this->getJson('/api/storage_units');
        $response->assertStatus(200)
                 ->assertJsonStructure([
                     'data',
                     'status',
                     'code',
                     'message'
                 ]);
    }

    public function test_can_create_StorageUnit(): void
    {
        $data = ['name' => 'Test StorageUnit'];

        $response = $this->postJson('/api/storage_units', $data);
        $response->assertStatus(201)
                 ->assertJsonStructure([
                     'data',
                     'status',
                     'code',
                     'message'
                 ]);

        $this->assertDatabaseHas('storage_units', $data);
    }

    public function test_can_show_StorageUnit(): void
    {
        $StorageUnit = StorageUnit::factory()->create();

        $response = $this->getJson('/api/storage_units/' . $StorageUnit->id);
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

    public function test_can_update_StorageUnit(): void
    {
        $StorageUnit = StorageUnit::factory()->create();
        $data = ['name' => 'Updated StorageUnit'];

        $response = $this->putJson('/api/storage_units/' . $StorageUnit->id, $data);
        $response->assertStatus(200)
                 ->assertJsonStructure([
                     'data',
                     'status',
                     'code',
                     'message'
                 ]);

        $this->assertDatabaseHas('storage_units', $data);
    }

    public function test_can_delete_StorageUnit(): void
    {
        $StorageUnit = StorageUnit::factory()->create();

        $response = $this->deleteJson('/api/storage_units/' . $StorageUnit->id);
        $response->assertStatus(200)
                 ->assertJsonStructure([
                     'status',
                     'code',
                     'message'
                 ]);

        $this->assertDatabaseMissing('storage_units', ['id' => $StorageUnit->id]);
    }

    public function test_validation_errors_on_create(): void
    {
        $response = $this->postJson('/api/storage_units', []);
        $response->assertStatus(422)
                 ->assertJsonValidationErrors(['name']);
    }
}
