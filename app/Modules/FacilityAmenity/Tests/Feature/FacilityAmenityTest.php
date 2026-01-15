<?php

namespace App\Modules\FacilityAmenity\Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;
use App\Modules\FacilityAmenity\Models\FacilityAmenity;

class FacilityAmenityTest extends TestCase
{
    use RefreshDatabase;

    public function test_can_list_facility_amenities(): void
    {
        $response = $this->getJson('/api/facility_amenities');
        $response->assertStatus(200)
                 ->assertJsonStructure([
                     'data',
                     'status',
                     'code',
                     'message'
                 ]);
    }

    public function test_can_create_FacilityAmenity(): void
    {
        $data = ['name' => 'Test FacilityAmenity'];

        $response = $this->postJson('/api/facility_amenities', $data);
        $response->assertStatus(201)
                 ->assertJsonStructure([
                     'data',
                     'status',
                     'code',
                     'message'
                 ]);

        $this->assertDatabaseHas('facility_amenities', $data);
    }

    public function test_can_show_FacilityAmenity(): void
    {
        $FacilityAmenity = FacilityAmenity::factory()->create();

        $response = $this->getJson('/api/facility_amenities/' . $FacilityAmenity->id);
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

    public function test_can_update_FacilityAmenity(): void
    {
        $FacilityAmenity = FacilityAmenity::factory()->create();
        $data = ['name' => 'Updated FacilityAmenity'];

        $response = $this->putJson('/api/facility_amenities/' . $FacilityAmenity->id, $data);
        $response->assertStatus(200)
                 ->assertJsonStructure([
                     'data',
                     'status',
                     'code',
                     'message'
                 ]);

        $this->assertDatabaseHas('facility_amenities', $data);
    }

    public function test_can_delete_FacilityAmenity(): void
    {
        $FacilityAmenity = FacilityAmenity::factory()->create();

        $response = $this->deleteJson('/api/facility_amenities/' . $FacilityAmenity->id);
        $response->assertStatus(200)
                 ->assertJsonStructure([
                     'status',
                     'code',
                     'message'
                 ]);

        $this->assertDatabaseMissing('facility_amenities', ['id' => $FacilityAmenity->id]);
    }

    public function test_validation_errors_on_create(): void
    {
        $response = $this->postJson('/api/facility_amenities', []);
        $response->assertStatus(422)
                 ->assertJsonValidationErrors(['name']);
    }
}
