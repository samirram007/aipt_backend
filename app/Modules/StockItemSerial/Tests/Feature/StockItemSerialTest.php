<?php

namespace App\Modules\StockItemSerial\Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;
use App\Modules\StockItemSerial\Models\StockItemSerial;

class StockItemSerialTest extends TestCase
{
    use RefreshDatabase;

    public function test_can_list_stock_item_serials(): void
    {
        $response = $this->getJson('/api/stock_item_serials');
        $response->assertStatus(200)
                 ->assertJsonStructure([
                     'data',
                     'status',
                     'code',
                     'message'
                 ]);
    }

    public function test_can_create_StockItemSerial(): void
    {
        $data = ['name' => 'Test StockItemSerial'];

        $response = $this->postJson('/api/stock_item_serials', $data);
        $response->assertStatus(201)
                 ->assertJsonStructure([
                     'data',
                     'status',
                     'code',
                     'message'
                 ]);

        $this->assertDatabaseHas('stock_item_serials', $data);
    }

    public function test_can_show_StockItemSerial(): void
    {
        $StockItemSerial = StockItemSerial::factory()->create();

        $response = $this->getJson('/api/stock_item_serials/' . $StockItemSerial->id);
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

    public function test_can_update_StockItemSerial(): void
    {
        $StockItemSerial = StockItemSerial::factory()->create();
        $data = ['name' => 'Updated StockItemSerial'];

        $response = $this->putJson('/api/stock_item_serials/' . $StockItemSerial->id, $data);
        $response->assertStatus(200)
                 ->assertJsonStructure([
                     'data',
                     'status',
                     'code',
                     'message'
                 ]);

        $this->assertDatabaseHas('stock_item_serials', $data);
    }

    public function test_can_delete_StockItemSerial(): void
    {
        $StockItemSerial = StockItemSerial::factory()->create();

        $response = $this->deleteJson('/api/stock_item_serials/' . $StockItemSerial->id);
        $response->assertStatus(200)
                 ->assertJsonStructure([
                     'status',
                     'code',
                     'message'
                 ]);

        $this->assertDatabaseMissing('stock_item_serials', ['id' => $StockItemSerial->id]);
    }

    public function test_validation_errors_on_create(): void
    {
        $response = $this->postJson('/api/stock_item_serials', []);
        $response->assertStatus(422)
                 ->assertJsonValidationErrors(['name']);
    }
}
