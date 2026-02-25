<?php

namespace App\Modules\CostCenter\Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;
use App\Modules\CostCenter\Models\CostCenter;

class CostCenterTest extends TestCase
{
    use RefreshDatabase;

    public function test_can_list_cost_centers(): void
    {
        $response = $this->getJson('/api/cost_centers');
        $response->assertStatus(200)
                 ->assertJsonStructure([
                     'data',
                     'status',
                     'code',
                     'message'
                 ]);
    }

    public function test_can_create_CostCenter(): void
    {
        $data = ['name' => 'Test CostCenter'];

        $response = $this->postJson('/api/cost_centers', $data);
        $response->assertStatus(201)
                 ->assertJsonStructure([
                     'data',
                     'status',
                     'code',
                     'message'
                 ]);

        $this->assertDatabaseHas('cost_centers', $data);
    }

    public function test_can_show_CostCenter(): void
    {
        $CostCenter = CostCenter::factory()->create();

        $response = $this->getJson('/api/cost_centers/' . $CostCenter->id);
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

    public function test_can_update_CostCenter(): void
    {
        $CostCenter = CostCenter::factory()->create();
        $data = ['name' => 'Updated CostCenter'];

        $response = $this->putJson('/api/cost_centers/' . $CostCenter->id, $data);
        $response->assertStatus(200)
                 ->assertJsonStructure([
                     'data',
                     'status',
                     'code',
                     'message'
                 ]);

        $this->assertDatabaseHas('cost_centers', $data);
    }

    public function test_can_delete_CostCenter(): void
    {
        $CostCenter = CostCenter::factory()->create();

        $response = $this->deleteJson('/api/cost_centers/' . $CostCenter->id);
        $response->assertStatus(200)
                 ->assertJsonStructure([
                     'status',
                     'code',
                     'message'
                 ]);

        $this->assertDatabaseMissing('cost_centers', ['id' => $CostCenter->id]);
    }

    public function test_validation_errors_on_create(): void
    {
        $response = $this->postJson('/api/cost_centers', []);
        $response->assertStatus(422)
                 ->assertJsonValidationErrors(['name']);
    }
}
