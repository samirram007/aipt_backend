<?php

namespace App\Modules\StockJournalBatchEntry\Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;
use App\Modules\StockJournalBatchEntry\Models\StockJournalBatchEntry;

class StockJournalBatchEntryTest extends TestCase
{
    use RefreshDatabase;

    public function test_can_list_stock_journal_batch_entries(): void
    {
        $response = $this->getJson('/api/stock_journal_batch_entries');
        $response->assertStatus(200)
                 ->assertJsonStructure([
                     'data',
                     'status',
                     'code',
                     'message'
                 ]);
    }

    public function test_can_create_StockJournalBatchEntry(): void
    {
        $data = ['name' => 'Test StockJournalBatchEntry'];

        $response = $this->postJson('/api/stock_journal_batch_entries', $data);
        $response->assertStatus(201)
                 ->assertJsonStructure([
                     'data',
                     'status',
                     'code',
                     'message'
                 ]);

        $this->assertDatabaseHas('stock_journal_batch_entries', $data);
    }

    public function test_can_show_StockJournalBatchEntry(): void
    {
        $StockJournalBatchEntry = StockJournalBatchEntry::factory()->create();

        $response = $this->getJson('/api/stock_journal_batch_entries/' . $StockJournalBatchEntry->id);
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

    public function test_can_update_StockJournalBatchEntry(): void
    {
        $StockJournalBatchEntry = StockJournalBatchEntry::factory()->create();
        $data = ['name' => 'Updated StockJournalBatchEntry'];

        $response = $this->putJson('/api/stock_journal_batch_entries/' . $StockJournalBatchEntry->id, $data);
        $response->assertStatus(200)
                 ->assertJsonStructure([
                     'data',
                     'status',
                     'code',
                     'message'
                 ]);

        $this->assertDatabaseHas('stock_journal_batch_entries', $data);
    }

    public function test_can_delete_StockJournalBatchEntry(): void
    {
        $StockJournalBatchEntry = StockJournalBatchEntry::factory()->create();

        $response = $this->deleteJson('/api/stock_journal_batch_entries/' . $StockJournalBatchEntry->id);
        $response->assertStatus(200)
                 ->assertJsonStructure([
                     'status',
                     'code',
                     'message'
                 ]);

        $this->assertDatabaseMissing('stock_journal_batch_entries', ['id' => $StockJournalBatchEntry->id]);
    }

    public function test_validation_errors_on_create(): void
    {
        $response = $this->postJson('/api/stock_journal_batch_entries', []);
        $response->assertStatus(422)
                 ->assertJsonValidationErrors(['name']);
    }
}
