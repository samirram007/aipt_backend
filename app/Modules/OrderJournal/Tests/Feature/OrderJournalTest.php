<?php

namespace App\Modules\OrderJournal\Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;
use App\Modules\OrderJournal\Models\OrderJournal;

class OrderJournalTest extends TestCase
{
    use RefreshDatabase;

    public function test_can_list_order_journals(): void
    {
        $response = $this->getJson('/api/order_journals');
        $response->assertStatus(200)
                 ->assertJsonStructure([
                     'data',
                     'status',
                     'code',
                     'message'
                 ]);
    }

    public function test_can_create_OrderJournal(): void
    {
        $data = ['name' => 'Test OrderJournal'];

        $response = $this->postJson('/api/order_journals', $data);
        $response->assertStatus(201)
                 ->assertJsonStructure([
                     'data',
                     'status',
                     'code',
                     'message'
                 ]);

        $this->assertDatabaseHas('order_journals', $data);
    }

    public function test_can_show_OrderJournal(): void
    {
        $OrderJournal = OrderJournal::factory()->create();

        $response = $this->getJson('/api/order_journals/' . $OrderJournal->id);
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

    public function test_can_update_OrderJournal(): void
    {
        $OrderJournal = OrderJournal::factory()->create();
        $data = ['name' => 'Updated OrderJournal'];

        $response = $this->putJson('/api/order_journals/' . $OrderJournal->id, $data);
        $response->assertStatus(200)
                 ->assertJsonStructure([
                     'data',
                     'status',
                     'code',
                     'message'
                 ]);

        $this->assertDatabaseHas('order_journals', $data);
    }

    public function test_can_delete_OrderJournal(): void
    {
        $OrderJournal = OrderJournal::factory()->create();

        $response = $this->deleteJson('/api/order_journals/' . $OrderJournal->id);
        $response->assertStatus(200)
                 ->assertJsonStructure([
                     'status',
                     'code',
                     'message'
                 ]);

        $this->assertDatabaseMissing('order_journals', ['id' => $OrderJournal->id]);
    }

    public function test_validation_errors_on_create(): void
    {
        $response = $this->postJson('/api/order_journals', []);
        $response->assertStatus(422)
                 ->assertJsonValidationErrors(['name']);
    }
}
