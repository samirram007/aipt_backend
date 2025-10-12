<?php

namespace App\Modules\CostCategory\Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;
use App\Modules\CostCategory\Models\CostCategory;

class CostCategoryTest extends TestCase
{
    use RefreshDatabase;

    public function test_can_list_cost_categories(): void
    {
        $response = $this->getJson('/api/cost_categories');
        $response->assertStatus(200)
                 ->assertJsonStructure([
                     'data',
                     'status',
                     'code',
                     'message'
                 ]);
    }

    public function test_can_create_CostCategory(): void
    {
        $data = ['name' => 'Test CostCategory'];

        $response = $this->postJson('/api/cost_categories', $data);
        $response->assertStatus(201)
                 ->assertJsonStructure([
                     'data',
                     'status',
                     'code',
                     'message'
                 ]);

        $this->assertDatabaseHas('cost_categories', $data);
    }

    public function test_can_show_CostCategory(): void
    {
        $CostCategory = CostCategory::factory()->create();

        $response = $this->getJson('/api/cost_categories/' . $CostCategory->id);
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

    public function test_can_update_CostCategory(): void
    {
        $CostCategory = CostCategory::factory()->create();
        $data = ['name' => 'Updated CostCategory'];

        $response = $this->putJson('/api/cost_categories/' . $CostCategory->id, $data);
        $response->assertStatus(200)
                 ->assertJsonStructure([
                     'data',
                     'status',
                     'code',
                     'message'
                 ]);

        $this->assertDatabaseHas('cost_categories', $data);
    }

    public function test_can_delete_CostCategory(): void
    {
        $CostCategory = CostCategory::factory()->create();

        $response = $this->deleteJson('/api/cost_categories/' . $CostCategory->id);
        $response->assertStatus(200)
                 ->assertJsonStructure([
                     'status',
                     'code',
                     'message'
                 ]);

        $this->assertDatabaseMissing('cost_categories', ['id' => $CostCategory->id]);
    }

    public function test_validation_errors_on_create(): void
    {
        $response = $this->postJson('/api/cost_categories', []);
        $response->assertStatus(422)
                 ->assertJsonValidationErrors(['name']);
    }
}
