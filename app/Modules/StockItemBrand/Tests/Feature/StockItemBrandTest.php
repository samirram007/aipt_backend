<?php

namespace App\Modules\StockItemBrand\Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;
use App\Modules\StockItemBrand\Models\StockItemBrand;

class StockItemBrandTest extends TestCase
{
    use RefreshDatabase;

    public function test_can_list_stock_item_brands(): void
    {
        $response = $this->getJson('/api/stock_item_brands');
        $response->assertStatus(200)
                 ->assertJsonStructure([
                     'data',
                     'status',
                     'code',
                     'message'
                 ]);
    }

    public function test_can_create_StockItemBrand(): void
    {
        $data = ['name' => 'Test StockItemBrand'];

        $response = $this->postJson('/api/stock_item_brands', $data);
        $response->assertStatus(201)
                 ->assertJsonStructure([
                     'data',
                     'status',
                     'code',
                     'message'
                 ]);

        $this->assertDatabaseHas('stock_item_brands', $data);
    }

    public function test_can_show_StockItemBrand(): void
    {
        $StockItemBrand = StockItemBrand::factory()->create();

        $response = $this->getJson('/api/stock_item_brands/' . $StockItemBrand->id);
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

    public function test_can_update_StockItemBrand(): void
    {
        $StockItemBrand = StockItemBrand::factory()->create();
        $data = ['name' => 'Updated StockItemBrand'];

        $response = $this->putJson('/api/stock_item_brands/' . $StockItemBrand->id, $data);
        $response->assertStatus(200)
                 ->assertJsonStructure([
                     'data',
                     'status',
                     'code',
                     'message'
                 ]);

        $this->assertDatabaseHas('stock_item_brands', $data);
    }

    public function test_can_delete_StockItemBrand(): void
    {
        $StockItemBrand = StockItemBrand::factory()->create();

        $response = $this->deleteJson('/api/stock_item_brands/' . $StockItemBrand->id);
        $response->assertStatus(200)
                 ->assertJsonStructure([
                     'status',
                     'code',
                     'message'
                 ]);

        $this->assertDatabaseMissing('stock_item_brands', ['id' => $StockItemBrand->id]);
    }

    public function test_validation_errors_on_create(): void
    {
        $response = $this->postJson('/api/stock_item_brands', []);
        $response->assertStatus(422)
                 ->assertJsonValidationErrors(['name']);
    }
}
