<?php

namespace App\Modules\StockUnit\Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;
use App\Modules\StockUnit\Models\StockUnit;

class StockUnitTest extends TestCase
{
    use RefreshDatabase;

    public function test_can_list_stock_units(): void
    {
        $response = $this->getJson('/api/stock_units');
        $response->assertStatus(200)
                 ->assertJsonStructure([
                     'data',
                     'status',
                     'code',
                     'message'
                 ]);
    }

    public function test_can_create_StockUnit(): void
    {
        $data = ['name' => 'Test StockUnit'];

        $response = $this->postJson('/api/stock_units', $data);
        $response->assertStatus(201)
                 ->assertJsonStructure([
                     'data',
                     'status',
                     'code',
                     'message'
                 ]);

        $this->assertDatabaseHas('stock_units', $data);
    }

    public function test_can_show_StockUnit(): void
    {
        $StockUnit = StockUnit::factory()->create();

        $response = $this->getJson('/api/stock_units/' . $StockUnit->id);
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

    public function test_can_update_StockUnit(): void
    {
        $StockUnit = StockUnit::factory()->create();
        $data = ['name' => 'Updated StockUnit'];

        $response = $this->putJson('/api/stock_units/' . $StockUnit->id, $data);
        $response->assertStatus(200)
                 ->assertJsonStructure([
                     'data',
                     'status',
                     'code',
                     'message'
                 ]);

        $this->assertDatabaseHas('stock_units', $data);
    }

    public function test_can_delete_StockUnit(): void
    {
        $StockUnit = StockUnit::factory()->create();

        $response = $this->deleteJson('/api/stock_units/' . $StockUnit->id);
        $response->assertStatus(200)
                 ->assertJsonStructure([
                     'status',
                     'code',
                     'message'
                 ]);

        $this->assertDatabaseMissing('stock_units', ['id' => $StockUnit->id]);
    }

    public function test_validation_errors_on_create(): void
    {
        $response = $this->postJson('/api/stock_units', []);
        $response->assertStatus(422)
                 ->assertJsonValidationErrors(['name']);
    }
}
