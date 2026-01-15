<?php

namespace App\Modules\FacilityCapitalItem\Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;
use App\Modules\FacilityCapitalItem\Models\FacilityCapitalItem;

class FacilityCapitalItemTest extends TestCase
{
    use RefreshDatabase;

    public function test_can_list_facility_capital_items(): void
    {
        $response = $this->getJson('/api/facility_capital_items');
        $response->assertStatus(200)
                 ->assertJsonStructure([
                     'data',
                     'status',
                     'code',
                     'message'
                 ]);
    }

    public function test_can_create_FacilityCapitalItem(): void
    {
        $data = ['name' => 'Test FacilityCapitalItem'];

        $response = $this->postJson('/api/facility_capital_items', $data);
        $response->assertStatus(201)
                 ->assertJsonStructure([
                     'data',
                     'status',
                     'code',
                     'message'
                 ]);

        $this->assertDatabaseHas('facility_capital_items', $data);
    }

    public function test_can_show_FacilityCapitalItem(): void
    {
        $FacilityCapitalItem = FacilityCapitalItem::factory()->create();

        $response = $this->getJson('/api/facility_capital_items/' . $FacilityCapitalItem->id);
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

    public function test_can_update_FacilityCapitalItem(): void
    {
        $FacilityCapitalItem = FacilityCapitalItem::factory()->create();
        $data = ['name' => 'Updated FacilityCapitalItem'];

        $response = $this->putJson('/api/facility_capital_items/' . $FacilityCapitalItem->id, $data);
        $response->assertStatus(200)
                 ->assertJsonStructure([
                     'data',
                     'status',
                     'code',
                     'message'
                 ]);

        $this->assertDatabaseHas('facility_capital_items', $data);
    }

    public function test_can_delete_FacilityCapitalItem(): void
    {
        $FacilityCapitalItem = FacilityCapitalItem::factory()->create();

        $response = $this->deleteJson('/api/facility_capital_items/' . $FacilityCapitalItem->id);
        $response->assertStatus(200)
                 ->assertJsonStructure([
                     'status',
                     'code',
                     'message'
                 ]);

        $this->assertDatabaseMissing('facility_capital_items', ['id' => $FacilityCapitalItem->id]);
    }

    public function test_validation_errors_on_create(): void
    {
        $response = $this->postJson('/api/facility_capital_items', []);
        $response->assertStatus(422)
                 ->assertJsonValidationErrors(['name']);
    }
}
