<?php

namespace App\Modules\StockJournalEntry\Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;
use App\Modules\StockJournalEntry\Models\StockJournalEntry;

class StockJournalEntryTest extends TestCase
{
    use RefreshDatabase;

    public function test_can_list_stock_journal_entries(): void
    {
        $response = $this->getJson('/api/stock_journal_entries');
        $response->assertStatus(200)
                 ->assertJsonStructure([
                     'data',
                     'status',
                     'code',
                     'message'
                 ]);
    }

    public function test_can_create_StockJournalEntry(): void
    {
        $data = ['name' => 'Test StockJournalEntry'];

        $response = $this->postJson('/api/stock_journal_entries', $data);
        $response->assertStatus(201)
                 ->assertJsonStructure([
                     'data',
                     'status',
                     'code',
                     'message'
                 ]);

        $this->assertDatabaseHas('stock_journal_entries', $data);
    }

    public function test_can_show_StockJournalEntry(): void
    {
        $StockJournalEntry = StockJournalEntry::factory()->create();

        $response = $this->getJson('/api/stock_journal_entries/' . $StockJournalEntry->id);
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

    public function test_can_update_StockJournalEntry(): void
    {
        $StockJournalEntry = StockJournalEntry::factory()->create();
        $data = ['name' => 'Updated StockJournalEntry'];

        $response = $this->putJson('/api/stock_journal_entries/' . $StockJournalEntry->id, $data);
        $response->assertStatus(200)
                 ->assertJsonStructure([
                     'data',
                     'status',
                     'code',
                     'message'
                 ]);

        $this->assertDatabaseHas('stock_journal_entries', $data);
    }

    public function test_can_delete_StockJournalEntry(): void
    {
        $StockJournalEntry = StockJournalEntry::factory()->create();

        $response = $this->deleteJson('/api/stock_journal_entries/' . $StockJournalEntry->id);
        $response->assertStatus(200)
                 ->assertJsonStructure([
                     'status',
                     'code',
                     'message'
                 ]);

        $this->assertDatabaseMissing('stock_journal_entries', ['id' => $StockJournalEntry->id]);
    }

    public function test_validation_errors_on_create(): void
    {
        $response = $this->postJson('/api/stock_journal_entries', []);
        $response->assertStatus(422)
                 ->assertJsonValidationErrors(['name']);
    }
}
