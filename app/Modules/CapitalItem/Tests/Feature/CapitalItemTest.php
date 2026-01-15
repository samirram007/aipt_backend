<?php

namespace App\Modules\CapitalItem\Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;
use App\Modules\CapitalItem\Models\CapitalItem;

class CapitalItemTest extends TestCase
{
    use RefreshDatabase;

    public function test_can_list_capital_items(): void
    {
        $response = $this->getJson('/api/capital_items');
        $response->assertStatus(200)
                 ->assertJsonStructure([
                     'data',
                     'status',
                     'code',
                     'message'
                 ]);
    }

    public function test_can_create_CapitalItem(): void
    {
        $data = ['name' => 'Test CapitalItem'];

        $response = $this->postJson('/api/capital_items', $data);
        $response->assertStatus(201)
                 ->assertJsonStructure([
                     'data',
                     'status',
                     'code',
                     'message'
                 ]);

        $this->assertDatabaseHas('capital_items', $data);
    }

    public function test_can_show_CapitalItem(): void
    {
        $CapitalItem = CapitalItem::factory()->create();

        $response = $this->getJson('/api/capital_items/' . $CapitalItem->id);
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

    public function test_can_update_CapitalItem(): void
    {
        $CapitalItem = CapitalItem::factory()->create();
        $data = ['name' => 'Updated CapitalItem'];

        $response = $this->putJson('/api/capital_items/' . $CapitalItem->id, $data);
        $response->assertStatus(200)
                 ->assertJsonStructure([
                     'data',
                     'status',
                     'code',
                     'message'
                 ]);

        $this->assertDatabaseHas('capital_items', $data);
    }

    public function test_can_delete_CapitalItem(): void
    {
        $CapitalItem = CapitalItem::factory()->create();

        $response = $this->deleteJson('/api/capital_items/' . $CapitalItem->id);
        $response->assertStatus(200)
                 ->assertJsonStructure([
                     'status',
                     'code',
                     'message'
                 ]);

        $this->assertDatabaseMissing('capital_items', ['id' => $CapitalItem->id]);
    }

    public function test_validation_errors_on_create(): void
    {
        $response = $this->postJson('/api/capital_items', []);
        $response->assertStatus(422)
                 ->assertJsonValidationErrors(['name']);
    }
}
