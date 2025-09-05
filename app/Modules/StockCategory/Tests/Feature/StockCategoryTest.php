<?php

namespace App\Modules\StockCategory\Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;
use App\Modules\StockCategory\Models\StockCategory;

class StockCategoryTest extends TestCase
{
    use RefreshDatabase;

    public function test_can_list_stock_categories(): void
    {
        $response = $this->getJson('/api/stock_categories');
        $response->assertStatus(200)
                 ->assertJsonStructure([
                     'data',
                     'status',
                     'code',
                     'message'
                 ]);
    }

    public function test_can_create_StockCategory(): void
    {
        $data = ['name' => 'Test StockCategory'];

        $response = $this->postJson('/api/stock_categories', $data);
        $response->assertStatus(201)
                 ->assertJsonStructure([
                     'data',
                     'status',
                     'code',
                     'message'
                 ]);

        $this->assertDatabaseHas('stock_categories', $data);
    }

    public function test_can_show_StockCategory(): void
    {
        $StockCategory = StockCategory::factory()->create();

        $response = $this->getJson('/api/stock_categories/' . $StockCategory->id);
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

    public function test_can_update_StockCategory(): void
    {
        $StockCategory = StockCategory::factory()->create();
        $data = ['name' => 'Updated StockCategory'];

        $response = $this->putJson('/api/stock_categories/' . $StockCategory->id, $data);
        $response->assertStatus(200)
                 ->assertJsonStructure([
                     'data',
                     'status',
                     'code',
                     'message'
                 ]);

        $this->assertDatabaseHas('stock_categories', $data);
    }

    public function test_can_delete_StockCategory(): void
    {
        $StockCategory = StockCategory::factory()->create();

        $response = $this->deleteJson('/api/stock_categories/' . $StockCategory->id);
        $response->assertStatus(200)
                 ->assertJsonStructure([
                     'status',
                     'code',
                     'message'
                 ]);

        $this->assertDatabaseMissing('stock_categories', ['id' => $StockCategory->id]);
    }

    public function test_validation_errors_on_create(): void
    {
        $response = $this->postJson('/api/stock_categories', []);
        $response->assertStatus(422)
                 ->assertJsonValidationErrors(['name']);
    }
}
