<?php

namespace App\Modules\StockJournalEntryPurge\Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;
use App\Modules\StockJournalEntryPurge\Models\StockJournalEntryPurge;

class StockJournalEntryPurgeTest extends TestCase
{
    use RefreshDatabase;

    public function test_can_list_stock_journal_entry_purges(): void
    {
        $response = $this->getJson('/api/stock_journal_entry_purges');
        $response->assertStatus(200)
                 ->assertJsonStructure([
                     'data',
                     'status',
                     'code',
                     'message'
                 ]);
    }

    public function test_can_create_StockJournalEntryPurge(): void
    {
        $data = ['name' => 'Test StockJournalEntryPurge'];

        $response = $this->postJson('/api/stock_journal_entry_purges', $data);
        $response->assertStatus(201)
                 ->assertJsonStructure([
                     'data',
                     'status',
                     'code',
                     'message'
                 ]);

        $this->assertDatabaseHas('stock_journal_entry_purges', $data);
    }

    public function test_can_show_StockJournalEntryPurge(): void
    {
        $StockJournalEntryPurge = StockJournalEntryPurge::factory()->create();

        $response = $this->getJson('/api/stock_journal_entry_purges/' . $StockJournalEntryPurge->id);
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

    public function test_can_update_StockJournalEntryPurge(): void
    {
        $StockJournalEntryPurge = StockJournalEntryPurge::factory()->create();
        $data = ['name' => 'Updated StockJournalEntryPurge'];

        $response = $this->putJson('/api/stock_journal_entry_purges/' . $StockJournalEntryPurge->id, $data);
        $response->assertStatus(200)
                 ->assertJsonStructure([
                     'data',
                     'status',
                     'code',
                     'message'
                 ]);

        $this->assertDatabaseHas('stock_journal_entry_purges', $data);
    }

    public function test_can_delete_StockJournalEntryPurge(): void
    {
        $StockJournalEntryPurge = StockJournalEntryPurge::factory()->create();

        $response = $this->deleteJson('/api/stock_journal_entry_purges/' . $StockJournalEntryPurge->id);
        $response->assertStatus(200)
                 ->assertJsonStructure([
                     'status',
                     'code',
                     'message'
                 ]);

        $this->assertDatabaseMissing('stock_journal_entry_purges', ['id' => $StockJournalEntryPurge->id]);
    }

    public function test_validation_errors_on_create(): void
    {
        $response = $this->postJson('/api/stock_journal_entry_purges', []);
        $response->assertStatus(422)
                 ->assertJsonValidationErrors(['name']);
    }
}
