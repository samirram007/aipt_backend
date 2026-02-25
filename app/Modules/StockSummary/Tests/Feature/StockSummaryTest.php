<?php

namespace App\Modules\StockSummary\Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;
use App\Modules\StockSummary\Models\StockSummary;

class StockSummaryTest extends TestCase
{
    use RefreshDatabase;

    public function test_can_list_stock_summaries(): void
    {
        $response = $this->getJson('/api/stock_summaries');
        $response->assertStatus(200)
                 ->assertJsonStructure([
                     'data',
                     'status',
                     'code',
                     'message'
                 ]);
    }

    public function test_can_create_StockSummary(): void
    {
        $data = ['name' => 'Test StockSummary'];

        $response = $this->postJson('/api/stock_summaries', $data);
        $response->assertStatus(201)
                 ->assertJsonStructure([
                     'data',
                     'status',
                     'code',
                     'message'
                 ]);

        $this->assertDatabaseHas('stock_summaries', $data);
    }

    public function test_can_show_StockSummary(): void
    {
        $StockSummary = StockSummary::factory()->create();

        $response = $this->getJson('/api/stock_summaries/' . $StockSummary->id);
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

    public function test_can_update_StockSummary(): void
    {
        $StockSummary = StockSummary::factory()->create();
        $data = ['name' => 'Updated StockSummary'];

        $response = $this->putJson('/api/stock_summaries/' . $StockSummary->id, $data);
        $response->assertStatus(200)
                 ->assertJsonStructure([
                     'data',
                     'status',
                     'code',
                     'message'
                 ]);

        $this->assertDatabaseHas('stock_summaries', $data);
    }

    public function test_can_delete_StockSummary(): void
    {
        $StockSummary = StockSummary::factory()->create();

        $response = $this->deleteJson('/api/stock_summaries/' . $StockSummary->id);
        $response->assertStatus(200)
                 ->assertJsonStructure([
                     'status',
                     'code',
                     'message'
                 ]);

        $this->assertDatabaseMissing('stock_summaries', ['id' => $StockSummary->id]);
    }

    public function test_validation_errors_on_create(): void
    {
        $response = $this->postJson('/api/stock_summaries', []);
        $response->assertStatus(422)
                 ->assertJsonValidationErrors(['name']);
    }
}
