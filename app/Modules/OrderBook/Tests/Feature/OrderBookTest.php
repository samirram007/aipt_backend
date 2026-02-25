<?php

namespace App\Modules\OrderBook\Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;
use App\Modules\OrderBook\Models\OrderBook;

class OrderBookTest extends TestCase
{
    use RefreshDatabase;

    public function test_can_list_order_books(): void
    {
        $response = $this->getJson('/api/order_books');
        $response->assertStatus(200)
                 ->assertJsonStructure([
                     'data',
                     'status',
                     'code',
                     'message'
                 ]);
    }

    public function test_can_create_OrderBook(): void
    {
        $data = ['name' => 'Test OrderBook'];

        $response = $this->postJson('/api/order_books', $data);
        $response->assertStatus(201)
                 ->assertJsonStructure([
                     'data',
                     'status',
                     'code',
                     'message'
                 ]);

        $this->assertDatabaseHas('order_books', $data);
    }

    public function test_can_show_OrderBook(): void
    {
        $OrderBook = OrderBook::factory()->create();

        $response = $this->getJson('/api/order_books/' . $OrderBook->id);
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

    public function test_can_update_OrderBook(): void
    {
        $OrderBook = OrderBook::factory()->create();
        $data = ['name' => 'Updated OrderBook'];

        $response = $this->putJson('/api/order_books/' . $OrderBook->id, $data);
        $response->assertStatus(200)
                 ->assertJsonStructure([
                     'data',
                     'status',
                     'code',
                     'message'
                 ]);

        $this->assertDatabaseHas('order_books', $data);
    }

    public function test_can_delete_OrderBook(): void
    {
        $OrderBook = OrderBook::factory()->create();

        $response = $this->deleteJson('/api/order_books/' . $OrderBook->id);
        $response->assertStatus(200)
                 ->assertJsonStructure([
                     'status',
                     'code',
                     'message'
                 ]);

        $this->assertDatabaseMissing('order_books', ['id' => $OrderBook->id]);
    }

    public function test_validation_errors_on_create(): void
    {
        $response = $this->postJson('/api/order_books', []);
        $response->assertStatus(422)
                 ->assertJsonValidationErrors(['name']);
    }
}
