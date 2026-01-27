<?php

namespace App\Modules\PhysicalStock\Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;
use App\Modules\PhysicalStock\Models\PhysicalStock;

class PhysicalStockTest extends TestCase
{
    use RefreshDatabase;

    public function test_can_list_physical_stocks(): void
    {
        $response = $this->getJson('/api/physical_stocks');
        $response->assertStatus(200)
                 ->assertJsonStructure([
                     'data',
                     'status',
                     'code',
                     'message'
                 ]);
    }

    public function test_can_create_PhysicalStock(): void
    {
        $data = ['name' => 'Test PhysicalStock'];

        $response = $this->postJson('/api/physical_stocks', $data);
        $response->assertStatus(201)
                 ->assertJsonStructure([
                     'data',
                     'status',
                     'code',
                     'message'
                 ]);

        $this->assertDatabaseHas('physical_stocks', $data);
    }

    public function test_can_show_PhysicalStock(): void
    {
        $PhysicalStock = PhysicalStock::factory()->create();

        $response = $this->getJson('/api/physical_stocks/' . $PhysicalStock->id);
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

    public function test_can_update_PhysicalStock(): void
    {
        $PhysicalStock = PhysicalStock::factory()->create();
        $data = ['name' => 'Updated PhysicalStock'];

        $response = $this->putJson('/api/physical_stocks/' . $PhysicalStock->id, $data);
        $response->assertStatus(200)
                 ->assertJsonStructure([
                     'data',
                     'status',
                     'code',
                     'message'
                 ]);

        $this->assertDatabaseHas('physical_stocks', $data);
    }

    public function test_can_delete_PhysicalStock(): void
    {
        $PhysicalStock = PhysicalStock::factory()->create();

        $response = $this->deleteJson('/api/physical_stocks/' . $PhysicalStock->id);
        $response->assertStatus(200)
                 ->assertJsonStructure([
                     'status',
                     'code',
                     'message'
                 ]);

        $this->assertDatabaseMissing('physical_stocks', ['id' => $PhysicalStock->id]);
    }

    public function test_validation_errors_on_create(): void
    {
        $response = $this->postJson('/api/physical_stocks', []);
        $response->assertStatus(422)
                 ->assertJsonValidationErrors(['name']);
    }
}
