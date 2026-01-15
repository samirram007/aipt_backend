<?php

namespace App\Modules\AmenityCategory\Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;
use App\Modules\AmenityCategory\Models\AmenityCategory;

class AmenityCategoryTest extends TestCase
{
    use RefreshDatabase;

    public function test_can_list_amenity_categories(): void
    {
        $response = $this->getJson('/api/amenity_categories');
        $response->assertStatus(200)
                 ->assertJsonStructure([
                     'data',
                     'status',
                     'code',
                     'message'
                 ]);
    }

    public function test_can_create_AmenityCategory(): void
    {
        $data = ['name' => 'Test AmenityCategory'];

        $response = $this->postJson('/api/amenity_categories', $data);
        $response->assertStatus(201)
                 ->assertJsonStructure([
                     'data',
                     'status',
                     'code',
                     'message'
                 ]);

        $this->assertDatabaseHas('amenity_categories', $data);
    }

    public function test_can_show_AmenityCategory(): void
    {
        $AmenityCategory = AmenityCategory::factory()->create();

        $response = $this->getJson('/api/amenity_categories/' . $AmenityCategory->id);
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

    public function test_can_update_AmenityCategory(): void
    {
        $AmenityCategory = AmenityCategory::factory()->create();
        $data = ['name' => 'Updated AmenityCategory'];

        $response = $this->putJson('/api/amenity_categories/' . $AmenityCategory->id, $data);
        $response->assertStatus(200)
                 ->assertJsonStructure([
                     'data',
                     'status',
                     'code',
                     'message'
                 ]);

        $this->assertDatabaseHas('amenity_categories', $data);
    }

    public function test_can_delete_AmenityCategory(): void
    {
        $AmenityCategory = AmenityCategory::factory()->create();

        $response = $this->deleteJson('/api/amenity_categories/' . $AmenityCategory->id);
        $response->assertStatus(200)
                 ->assertJsonStructure([
                     'status',
                     'code',
                     'message'
                 ]);

        $this->assertDatabaseMissing('amenity_categories', ['id' => $AmenityCategory->id]);
    }

    public function test_validation_errors_on_create(): void
    {
        $response = $this->postJson('/api/amenity_categories', []);
        $response->assertStatus(422)
                 ->assertJsonValidationErrors(['name']);
    }
}
