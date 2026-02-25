<?php

namespace App\Modules\StockItemBatch\Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;
use App\Modules\StockItemBatch\Models\StockItemBatch;

class StockItemBatchTest extends TestCase
{
    use RefreshDatabase;

    public function test_can_list_stock_item_batches(): void
    {
        $response = $this->getJson('/api/stock_item_batches');
        $response->assertStatus(200)
                 ->assertJsonStructure([
                     'data',
                     'status',
                     'code',
                     'message'
                 ]);
    }

    public function test_can_create_StockItemBatch(): void
    {
        $data = ['name' => 'Test StockItemBatch'];

        $response = $this->postJson('/api/stock_item_batches', $data);
        $response->assertStatus(201)
                 ->assertJsonStructure([
                     'data',
                     'status',
                     'code',
                     'message'
                 ]);

        $this->assertDatabaseHas('stock_item_batches', $data);
    }

    public function test_can_show_StockItemBatch(): void
    {
        $StockItemBatch = StockItemBatch::factory()->create();

        $response = $this->getJson('/api/stock_item_batches/' . $StockItemBatch->id);
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

    public function test_can_update_StockItemBatch(): void
    {
        $StockItemBatch = StockItemBatch::factory()->create();
        $data = ['name' => 'Updated StockItemBatch'];

        $response = $this->putJson('/api/stock_item_batches/' . $StockItemBatch->id, $data);
        $response->assertStatus(200)
                 ->assertJsonStructure([
                     'data',
                     'status',
                     'code',
                     'message'
                 ]);

        $this->assertDatabaseHas('stock_item_batches', $data);
    }

    public function test_can_delete_StockItemBatch(): void
    {
        $StockItemBatch = StockItemBatch::factory()->create();

        $response = $this->deleteJson('/api/stock_item_batches/' . $StockItemBatch->id);
        $response->assertStatus(200)
                 ->assertJsonStructure([
                     'status',
                     'code',
                     'message'
                 ]);

        $this->assertDatabaseMissing('stock_item_batches', ['id' => $StockItemBatch->id]);
    }

    public function test_validation_errors_on_create(): void
    {
        $response = $this->postJson('/api/stock_item_batches', []);
        $response->assertStatus(422)
                 ->assertJsonValidationErrors(['name']);
    }
}
