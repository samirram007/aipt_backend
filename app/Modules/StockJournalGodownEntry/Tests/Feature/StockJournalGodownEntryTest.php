<?php

namespace App\Modules\StockJournalGodownEntry\Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;
use App\Modules\StockJournalGodownEntry\Models\StockJournalGodownEntry;

class StockJournalGodownEntryTest extends TestCase
{
    use RefreshDatabase;

    public function test_can_list_stock_journal_godown_entries(): void
    {
        $response = $this->getJson('/api/stock_journal_godown_entries');
        $response->assertStatus(200)
                 ->assertJsonStructure([
                     'data',
                     'status',
                     'code',
                     'message'
                 ]);
    }

    public function test_can_create_StockJournalGodownEntry(): void
    {
        $data = ['name' => 'Test StockJournalGodownEntry'];

        $response = $this->postJson('/api/stock_journal_godown_entries', $data);
        $response->assertStatus(201)
                 ->assertJsonStructure([
                     'data',
                     'status',
                     'code',
                     'message'
                 ]);

        $this->assertDatabaseHas('stock_journal_godown_entries', $data);
    }

    public function test_can_show_StockJournalGodownEntry(): void
    {
        $StockJournalGodownEntry = StockJournalGodownEntry::factory()->create();

        $response = $this->getJson('/api/stock_journal_godown_entries/' . $StockJournalGodownEntry->id);
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

    public function test_can_update_StockJournalGodownEntry(): void
    {
        $StockJournalGodownEntry = StockJournalGodownEntry::factory()->create();
        $data = ['name' => 'Updated StockJournalGodownEntry'];

        $response = $this->putJson('/api/stock_journal_godown_entries/' . $StockJournalGodownEntry->id, $data);
        $response->assertStatus(200)
                 ->assertJsonStructure([
                     'data',
                     'status',
                     'code',
                     'message'
                 ]);

        $this->assertDatabaseHas('stock_journal_godown_entries', $data);
    }

    public function test_can_delete_StockJournalGodownEntry(): void
    {
        $StockJournalGodownEntry = StockJournalGodownEntry::factory()->create();

        $response = $this->deleteJson('/api/stock_journal_godown_entries/' . $StockJournalGodownEntry->id);
        $response->assertStatus(200)
                 ->assertJsonStructure([
                     'status',
                     'code',
                     'message'
                 ]);

        $this->assertDatabaseMissing('stock_journal_godown_entries', ['id' => $StockJournalGodownEntry->id]);
    }

    public function test_validation_errors_on_create(): void
    {
        $response = $this->postJson('/api/stock_journal_godown_entries', []);
        $response->assertStatus(422)
                 ->assertJsonValidationErrors(['name']);
    }
}
