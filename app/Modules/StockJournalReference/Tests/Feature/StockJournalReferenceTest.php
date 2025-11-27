<?php

namespace App\Modules\StockJournalReference\Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;
use App\Modules\StockJournalReference\Models\StockJournalReference;

class StockJournalReferenceTest extends TestCase
{
    use RefreshDatabase;

    public function test_can_list_stock_journal_references(): void
    {
        $response = $this->getJson('/api/stock_journal_references');
        $response->assertStatus(200)
                 ->assertJsonStructure([
                     'data',
                     'status',
                     'code',
                     'message'
                 ]);
    }

    public function test_can_create_StockJournalReference(): void
    {
        $data = ['name' => 'Test StockJournalReference'];

        $response = $this->postJson('/api/stock_journal_references', $data);
        $response->assertStatus(201)
                 ->assertJsonStructure([
                     'data',
                     'status',
                     'code',
                     'message'
                 ]);

        $this->assertDatabaseHas('stock_journal_references', $data);
    }

    public function test_can_show_StockJournalReference(): void
    {
        $StockJournalReference = StockJournalReference::factory()->create();

        $response = $this->getJson('/api/stock_journal_references/' . $StockJournalReference->id);
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

    public function test_can_update_StockJournalReference(): void
    {
        $StockJournalReference = StockJournalReference::factory()->create();
        $data = ['name' => 'Updated StockJournalReference'];

        $response = $this->putJson('/api/stock_journal_references/' . $StockJournalReference->id, $data);
        $response->assertStatus(200)
                 ->assertJsonStructure([
                     'data',
                     'status',
                     'code',
                     'message'
                 ]);

        $this->assertDatabaseHas('stock_journal_references', $data);
    }

    public function test_can_delete_StockJournalReference(): void
    {
        $StockJournalReference = StockJournalReference::factory()->create();

        $response = $this->deleteJson('/api/stock_journal_references/' . $StockJournalReference->id);
        $response->assertStatus(200)
                 ->assertJsonStructure([
                     'status',
                     'code',
                     'message'
                 ]);

        $this->assertDatabaseMissing('stock_journal_references', ['id' => $StockJournalReference->id]);
    }

    public function test_validation_errors_on_create(): void
    {
        $response = $this->postJson('/api/stock_journal_references', []);
        $response->assertStatus(422)
                 ->assertJsonValidationErrors(['name']);
    }
}
