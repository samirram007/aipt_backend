<?php

namespace App\Modules\BomDetail\Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;
use App\Modules\BomDetail\Models\BomDetail;

class BomDetailTest extends TestCase
{
    use RefreshDatabase;

    public function test_can_list_bom_details(): void
    {
        $response = $this->getJson('/api/bom_details');
        $response->assertStatus(200)
                 ->assertJsonStructure([
                     'data',
                     'status',
                     'code',
                     'message'
                 ]);
    }

    public function test_can_create_BomDetail(): void
    {
        $data = ['name' => 'Test BomDetail'];

        $response = $this->postJson('/api/bom_details', $data);
        $response->assertStatus(201)
                 ->assertJsonStructure([
                     'data',
                     'status',
                     'code',
                     'message'
                 ]);

        $this->assertDatabaseHas('bom_details', $data);
    }

    public function test_can_show_BomDetail(): void
    {
        $BomDetail = BomDetail::factory()->create();

        $response = $this->getJson('/api/bom_details/' . $BomDetail->id);
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

    public function test_can_update_BomDetail(): void
    {
        $BomDetail = BomDetail::factory()->create();
        $data = ['name' => 'Updated BomDetail'];

        $response = $this->putJson('/api/bom_details/' . $BomDetail->id, $data);
        $response->assertStatus(200)
                 ->assertJsonStructure([
                     'data',
                     'status',
                     'code',
                     'message'
                 ]);

        $this->assertDatabaseHas('bom_details', $data);
    }

    public function test_can_delete_BomDetail(): void
    {
        $BomDetail = BomDetail::factory()->create();

        $response = $this->deleteJson('/api/bom_details/' . $BomDetail->id);
        $response->assertStatus(200)
                 ->assertJsonStructure([
                     'status',
                     'code',
                     'message'
                 ]);

        $this->assertDatabaseMissing('bom_details', ['id' => $BomDetail->id]);
    }

    public function test_validation_errors_on_create(): void
    {
        $response = $this->postJson('/api/bom_details', []);
        $response->assertStatus(422)
                 ->assertJsonValidationErrors(['name']);
    }
}
