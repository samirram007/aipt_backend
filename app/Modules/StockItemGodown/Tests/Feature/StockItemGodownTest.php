<?php

namespace App\Modules\StockItemGodown\Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;
use App\Modules\StockItemGodown\Models\StockItemGodown;

class StockItemGodownTest extends TestCase
{
    use RefreshDatabase;

    public function test_can_list_stock_item_godowns(): void
    {
        $response = $this->getJson('/api/stock_item_godowns');
        $response->assertStatus(200)
                 ->assertJsonStructure([
                     'data',
                     'status',
                     'code',
                     'message'
                 ]);
    }

    public function test_can_create_StockItemGodown(): void
    {
        $data = ['name' => 'Test StockItemGodown'];

        $response = $this->postJson('/api/stock_item_godowns', $data);
        $response->assertStatus(201)
                 ->assertJsonStructure([
                     'data',
                     'status',
                     'code',
                     'message'
                 ]);

        $this->assertDatabaseHas('stock_item_godowns', $data);
    }

    public function test_can_show_StockItemGodown(): void
    {
        $StockItemGodown = StockItemGodown::factory()->create();

        $response = $this->getJson('/api/stock_item_godowns/' . $StockItemGodown->id);
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

    public function test_can_update_StockItemGodown(): void
    {
        $StockItemGodown = StockItemGodown::factory()->create();
        $data = ['name' => 'Updated StockItemGodown'];

        $response = $this->putJson('/api/stock_item_godowns/' . $StockItemGodown->id, $data);
        $response->assertStatus(200)
                 ->assertJsonStructure([
                     'data',
                     'status',
                     'code',
                     'message'
                 ]);

        $this->assertDatabaseHas('stock_item_godowns', $data);
    }

    public function test_can_delete_StockItemGodown(): void
    {
        $StockItemGodown = StockItemGodown::factory()->create();

        $response = $this->deleteJson('/api/stock_item_godowns/' . $StockItemGodown->id);
        $response->assertStatus(200)
                 ->assertJsonStructure([
                     'status',
                     'code',
                     'message'
                 ]);

        $this->assertDatabaseMissing('stock_item_godowns', ['id' => $StockItemGodown->id]);
    }

    public function test_validation_errors_on_create(): void
    {
        $response = $this->postJson('/api/stock_item_godowns', []);
        $response->assertStatus(422)
                 ->assertJsonValidationErrors(['name']);
    }
}
