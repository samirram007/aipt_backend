<?php

namespace App\Modules\StockJournalStorageUnitEntry\Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;
use App\Modules\StockJournalStorageUnitEntry\Models\StockJournalStorageUnitEntry;

class StockJournalStorageUnitEntryTest extends TestCase
{
    use RefreshDatabase;

    public function test_can_list_stock_journal_storage_unit_entries(): void
    {
        $response = $this->getJson('/api/stock_journal_storage_unit_entries');
        $response->assertStatus(200)
                 ->assertJsonStructure([
                     'data',
                     'status',
                     'code',
                     'message'
                 ]);
    }

    public function test_can_create_StockJournalStorageUnitEntry(): void
    {
        $data = ['name' => 'Test StockJournalStorageUnitEntry'];

        $response = $this->postJson('/api/stock_journal_storage_unit_entries', $data);
        $response->assertStatus(201)
                 ->assertJsonStructure([
                     'data',
                     'status',
                     'code',
                     'message'
                 ]);

        $this->assertDatabaseHas('stock_journal_storage_unit_entries', $data);
    }

    public function test_can_show_StockJournalStorageUnitEntry(): void
    {
        $StockJournalStorageUnitEntry = StockJournalStorageUnitEntry::factory()->create();

        $response = $this->getJson('/api/stock_journal_storage_unit_entries/' . $StockJournalStorageUnitEntry->id);
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

    public function test_can_update_StockJournalStorageUnitEntry(): void
    {
        $StockJournalStorageUnitEntry = StockJournalStorageUnitEntry::factory()->create();
        $data = ['name' => 'Updated StockJournalStorageUnitEntry'];

        $response = $this->putJson('/api/stock_journal_storage_unit_entries/' . $StockJournalStorageUnitEntry->id, $data);
        $response->assertStatus(200)
                 ->assertJsonStructure([
                     'data',
                     'status',
                     'code',
                     'message'
                 ]);

        $this->assertDatabaseHas('stock_journal_storage_unit_entries', $data);
    }

    public function test_can_delete_StockJournalStorageUnitEntry(): void
    {
        $StockJournalStorageUnitEntry = StockJournalStorageUnitEntry::factory()->create();

        $response = $this->deleteJson('/api/stock_journal_storage_unit_entries/' . $StockJournalStorageUnitEntry->id);
        $response->assertStatus(200)
                 ->assertJsonStructure([
                     'status',
                     'code',
                     'message'
                 ]);

        $this->assertDatabaseMissing('stock_journal_storage_unit_entries', ['id' => $StockJournalStorageUnitEntry->id]);
    }

    public function test_validation_errors_on_create(): void
    {
        $response = $this->postJson('/api/stock_journal_storage_unit_entries', []);
        $response->assertStatus(422)
                 ->assertJsonValidationErrors(['name']);
    }
}
