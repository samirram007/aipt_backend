<?php

namespace App\Modules\StockJournal\Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;
use App\Modules\StockJournal\Models\StockJournal;

class StockJournalTest extends TestCase
{
    use RefreshDatabase;

    public function test_can_list_stock_journals(): void
    {
        $response = $this->getJson('/api/stock_journals');
        $response->assertStatus(200)
                 ->assertJsonStructure([
                     'data',
                     'status',
                     'code',
                     'message'
                 ]);
    }

    public function test_can_create_StockJournal(): void
    {
        $data = ['name' => 'Test StockJournal'];

        $response = $this->postJson('/api/stock_journals', $data);
        $response->assertStatus(201)
                 ->assertJsonStructure([
                     'data',
                     'status',
                     'code',
                     'message'
                 ]);

        $this->assertDatabaseHas('stock_journals', $data);
    }

    public function test_can_show_StockJournal(): void
    {
        $StockJournal = StockJournal::factory()->create();

        $response = $this->getJson('/api/stock_journals/' . $StockJournal->id);
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

    public function test_can_update_StockJournal(): void
    {
        $StockJournal = StockJournal::factory()->create();
        $data = ['name' => 'Updated StockJournal'];

        $response = $this->putJson('/api/stock_journals/' . $StockJournal->id, $data);
        $response->assertStatus(200)
                 ->assertJsonStructure([
                     'data',
                     'status',
                     'code',
                     'message'
                 ]);

        $this->assertDatabaseHas('stock_journals', $data);
    }

    public function test_can_delete_StockJournal(): void
    {
        $StockJournal = StockJournal::factory()->create();

        $response = $this->deleteJson('/api/stock_journals/' . $StockJournal->id);
        $response->assertStatus(200)
                 ->assertJsonStructure([
                     'status',
                     'code',
                     'message'
                 ]);

        $this->assertDatabaseMissing('stock_journals', ['id' => $StockJournal->id]);
    }

    public function test_validation_errors_on_create(): void
    {
        $response = $this->postJson('/api/stock_journals', []);
        $response->assertStatus(422)
                 ->assertJsonValidationErrors(['name']);
    }
}
