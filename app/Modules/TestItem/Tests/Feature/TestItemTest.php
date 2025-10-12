<?php

namespace App\Modules\TestItem\Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;
use App\Modules\TestItem\Models\TestItem;

class TestItemTest extends TestCase
{
    use RefreshDatabase;

    public function test_can_list_test_items(): void
    {
        $response = $this->getJson('/api/test_items');
        $response->assertStatus(200)
                 ->assertJsonStructure([
                     'data',
                     'status',
                     'code',
                     'message'
                 ]);
    }

    public function test_can_create_TestItem(): void
    {
        $data = ['name' => 'Test TestItem'];

        $response = $this->postJson('/api/test_items', $data);
        $response->assertStatus(201)
                 ->assertJsonStructure([
                     'data',
                     'status',
                     'code',
                     'message'
                 ]);

        $this->assertDatabaseHas('test_items', $data);
    }

    public function test_can_show_TestItem(): void
    {
        $TestItem = TestItem::factory()->create();

        $response = $this->getJson('/api/test_items/' . $TestItem->id);
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

    public function test_can_update_TestItem(): void
    {
        $TestItem = TestItem::factory()->create();
        $data = ['name' => 'Updated TestItem'];

        $response = $this->putJson('/api/test_items/' . $TestItem->id, $data);
        $response->assertStatus(200)
                 ->assertJsonStructure([
                     'data',
                     'status',
                     'code',
                     'message'
                 ]);

        $this->assertDatabaseHas('test_items', $data);
    }

    public function test_can_delete_TestItem(): void
    {
        $TestItem = TestItem::factory()->create();

        $response = $this->deleteJson('/api/test_items/' . $TestItem->id);
        $response->assertStatus(200)
                 ->assertJsonStructure([
                     'status',
                     'code',
                     'message'
                 ]);

        $this->assertDatabaseMissing('test_items', ['id' => $TestItem->id]);
    }

    public function test_validation_errors_on_create(): void
    {
        $response = $this->postJson('/api/test_items', []);
        $response->assertStatus(422)
                 ->assertJsonValidationErrors(['name']);
    }
}
