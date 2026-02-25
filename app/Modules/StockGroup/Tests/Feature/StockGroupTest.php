<?php

namespace App\Modules\StockGroup\Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;
use App\Modules\StockGroup\Models\StockGroup;

class StockGroupTest extends TestCase
{
    use RefreshDatabase;

    public function test_can_list_stock_groups(): void
    {
        $response = $this->getJson('/api/stock_groups');
        $response->assertStatus(200)
                 ->assertJsonStructure([
                     'data',
                     'status',
                     'code',
                     'message'
                 ]);
    }

    public function test_can_create_StockGroup(): void
    {
        $data = ['name' => 'Test StockGroup'];

        $response = $this->postJson('/api/stock_groups', $data);
        $response->assertStatus(201)
                 ->assertJsonStructure([
                     'data',
                     'status',
                     'code',
                     'message'
                 ]);

        $this->assertDatabaseHas('stock_groups', $data);
    }

    public function test_can_show_StockGroup(): void
    {
        $StockGroup = StockGroup::factory()->create();

        $response = $this->getJson('/api/stock_groups/' . $StockGroup->id);
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

    public function test_can_update_StockGroup(): void
    {
        $StockGroup = StockGroup::factory()->create();
        $data = ['name' => 'Updated StockGroup'];

        $response = $this->putJson('/api/stock_groups/' . $StockGroup->id, $data);
        $response->assertStatus(200)
                 ->assertJsonStructure([
                     'data',
                     'status',
                     'code',
                     'message'
                 ]);

        $this->assertDatabaseHas('stock_groups', $data);
    }

    public function test_can_delete_StockGroup(): void
    {
        $StockGroup = StockGroup::factory()->create();

        $response = $this->deleteJson('/api/stock_groups/' . $StockGroup->id);
        $response->assertStatus(200)
                 ->assertJsonStructure([
                     'status',
                     'code',
                     'message'
                 ]);

        $this->assertDatabaseMissing('stock_groups', ['id' => $StockGroup->id]);
    }

    public function test_validation_errors_on_create(): void
    {
        $response = $this->postJson('/api/stock_groups', []);
        $response->assertStatus(422)
                 ->assertJsonValidationErrors(['name']);
    }
}
