<?php

namespace App\Modules\StockItem\Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;
use App\Modules\StockItem\Models\StockItem;

class StockItemTest extends TestCase
{
    use RefreshDatabase;

    public function test_can_list_stock_items(): void
    {
        $response = $this->getJson('/api/stock_items');
        $response->assertStatus(200)
                 ->assertJsonStructure([
                     'data',
                     'status',
                     'code',
                     'message'
                 ]);
    }

    public function test_can_create_StockItem(): void
    {
        $data = ['name' => 'Test StockItem'];

        $response = $this->postJson('/api/stock_items', $data);
        $response->assertStatus(201)
                 ->assertJsonStructure([
                     'data',
                     'status',
                     'code',
                     'message'
                 ]);

        $this->assertDatabaseHas('stock_items', $data);
    }

    public function test_can_show_StockItem(): void
    {
        $StockItem = StockItem::factory()->create();

        $response = $this->getJson('/api/stock_items/' . $StockItem->id);
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

    public function test_can_update_StockItem(): void
    {
        $StockItem = StockItem::factory()->create();
        $data = ['name' => 'Updated StockItem'];

        $response = $this->putJson('/api/stock_items/' . $StockItem->id, $data);
        $response->assertStatus(200)
                 ->assertJsonStructure([
                     'data',
                     'status',
                     'code',
                     'message'
                 ]);

        $this->assertDatabaseHas('stock_items', $data);
    }

    public function test_can_delete_StockItem(): void
    {
        $StockItem = StockItem::factory()->create();

        $response = $this->deleteJson('/api/stock_items/' . $StockItem->id);
        $response->assertStatus(200)
                 ->assertJsonStructure([
                     'status',
                     'code',
                     'message'
                 ]);

        $this->assertDatabaseMissing('stock_items', ['id' => $StockItem->id]);
    }

    public function test_validation_errors_on_create(): void
    {
        $response = $this->postJson('/api/stock_items', []);
        $response->assertStatus(422)
                 ->assertJsonValidationErrors(['name']);
    }
}
