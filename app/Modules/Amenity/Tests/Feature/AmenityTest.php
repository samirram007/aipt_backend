<?php

namespace App\Modules\Amenity\Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;
use App\Modules\Amenity\Models\Amenity;

class AmenityTest extends TestCase
{
    use RefreshDatabase;

    public function test_can_list_amenities(): void
    {
        $response = $this->getJson('/api/amenities');
        $response->assertStatus(200)
                 ->assertJsonStructure([
                     'data',
                     'status',
                     'code',
                     'message'
                 ]);
    }

    public function test_can_create_Amenity(): void
    {
        $data = ['name' => 'Test Amenity'];

        $response = $this->postJson('/api/amenities', $data);
        $response->assertStatus(201)
                 ->assertJsonStructure([
                     'data',
                     'status',
                     'code',
                     'message'
                 ]);

        $this->assertDatabaseHas('amenities', $data);
    }

    public function test_can_show_Amenity(): void
    {
        $Amenity = Amenity::factory()->create();

        $response = $this->getJson('/api/amenities/' . $Amenity->id);
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

    public function test_can_update_Amenity(): void
    {
        $Amenity = Amenity::factory()->create();
        $data = ['name' => 'Updated Amenity'];

        $response = $this->putJson('/api/amenities/' . $Amenity->id, $data);
        $response->assertStatus(200)
                 ->assertJsonStructure([
                     'data',
                     'status',
                     'code',
                     'message'
                 ]);

        $this->assertDatabaseHas('amenities', $data);
    }

    public function test_can_delete_Amenity(): void
    {
        $Amenity = Amenity::factory()->create();

        $response = $this->deleteJson('/api/amenities/' . $Amenity->id);
        $response->assertStatus(200)
                 ->assertJsonStructure([
                     'status',
                     'code',
                     'message'
                 ]);

        $this->assertDatabaseMissing('amenities', ['id' => $Amenity->id]);
    }

    public function test_validation_errors_on_create(): void
    {
        $response = $this->postJson('/api/amenities', []);
        $response->assertStatus(422)
                 ->assertJsonValidationErrors(['name']);
    }
}
