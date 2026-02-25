<?php

namespace App\Modules\OrderStockJournal\Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;
use App\Modules\OrderStockJournal\Models\OrderStockJournal;

class OrderStockJournalTest extends TestCase
{
    use RefreshDatabase;

    public function test_can_list_order_stock_journals(): void
    {
        $response = $this->getJson('/api/order_stock_journals');
        $response->assertStatus(200)
                 ->assertJsonStructure([
                     'data',
                     'status',
                     'code',
                     'message'
                 ]);
    }

    public function test_can_create_OrderStockJournal(): void
    {
        $data = ['name' => 'Test OrderStockJournal'];

        $response = $this->postJson('/api/order_stock_journals', $data);
        $response->assertStatus(201)
                 ->assertJsonStructure([
                     'data',
                     'status',
                     'code',
                     'message'
                 ]);

        $this->assertDatabaseHas('order_stock_journals', $data);
    }

    public function test_can_show_OrderStockJournal(): void
    {
        $OrderStockJournal = OrderStockJournal::factory()->create();

        $response = $this->getJson('/api/order_stock_journals/' . $OrderStockJournal->id);
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

    public function test_can_update_OrderStockJournal(): void
    {
        $OrderStockJournal = OrderStockJournal::factory()->create();
        $data = ['name' => 'Updated OrderStockJournal'];

        $response = $this->putJson('/api/order_stock_journals/' . $OrderStockJournal->id, $data);
        $response->assertStatus(200)
                 ->assertJsonStructure([
                     'data',
                     'status',
                     'code',
                     'message'
                 ]);

        $this->assertDatabaseHas('order_stock_journals', $data);
    }

    public function test_can_delete_OrderStockJournal(): void
    {
        $OrderStockJournal = OrderStockJournal::factory()->create();

        $response = $this->deleteJson('/api/order_stock_journals/' . $OrderStockJournal->id);
        $response->assertStatus(200)
                 ->assertJsonStructure([
                     'status',
                     'code',
                     'message'
                 ]);

        $this->assertDatabaseMissing('order_stock_journals', ['id' => $OrderStockJournal->id]);
    }

    public function test_validation_errors_on_create(): void
    {
        $response = $this->postJson('/api/order_stock_journals', []);
        $response->assertStatus(422)
                 ->assertJsonValidationErrors(['name']);
    }
}
