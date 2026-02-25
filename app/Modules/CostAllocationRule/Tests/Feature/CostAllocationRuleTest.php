<?php

namespace App\Modules\CostAllocationRule\Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;
use App\Modules\CostAllocationRule\Models\CostAllocationRule;

class CostAllocationRuleTest extends TestCase
{
    use RefreshDatabase;

    public function test_can_list_cost_allocation_rules(): void
    {
        $response = $this->getJson('/api/cost_allocation_rules');
        $response->assertStatus(200)
                 ->assertJsonStructure([
                     'data',
                     'status',
                     'code',
                     'message'
                 ]);
    }

    public function test_can_create_CostAllocationRule(): void
    {
        $data = ['name' => 'Test CostAllocationRule'];

        $response = $this->postJson('/api/cost_allocation_rules', $data);
        $response->assertStatus(201)
                 ->assertJsonStructure([
                     'data',
                     'status',
                     'code',
                     'message'
                 ]);

        $this->assertDatabaseHas('cost_allocation_rules', $data);
    }

    public function test_can_show_CostAllocationRule(): void
    {
        $CostAllocationRule = CostAllocationRule::factory()->create();

        $response = $this->getJson('/api/cost_allocation_rules/' . $CostAllocationRule->id);
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

    public function test_can_update_CostAllocationRule(): void
    {
        $CostAllocationRule = CostAllocationRule::factory()->create();
        $data = ['name' => 'Updated CostAllocationRule'];

        $response = $this->putJson('/api/cost_allocation_rules/' . $CostAllocationRule->id, $data);
        $response->assertStatus(200)
                 ->assertJsonStructure([
                     'data',
                     'status',
                     'code',
                     'message'
                 ]);

        $this->assertDatabaseHas('cost_allocation_rules', $data);
    }

    public function test_can_delete_CostAllocationRule(): void
    {
        $CostAllocationRule = CostAllocationRule::factory()->create();

        $response = $this->deleteJson('/api/cost_allocation_rules/' . $CostAllocationRule->id);
        $response->assertStatus(200)
                 ->assertJsonStructure([
                     'status',
                     'code',
                     'message'
                 ]);

        $this->assertDatabaseMissing('cost_allocation_rules', ['id' => $CostAllocationRule->id]);
    }

    public function test_validation_errors_on_create(): void
    {
        $response = $this->postJson('/api/cost_allocation_rules', []);
        $response->assertStatus(422)
                 ->assertJsonValidationErrors(['name']);
    }
}
