<?php

namespace App\Modules\Country\Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;
use App\Modules\Country\Models\Country;

class CountryTest extends TestCase
{
    use RefreshDatabase;

    public function test_can_list_countries(): void
    {
        $response = $this->getJson('/api/countries');
        $response->assertStatus(200)
                 ->assertJsonStructure([
                     'data',
                     'status',
                     'code',
                     'message'
                 ]);
    }

    public function test_can_create_Country(): void
    {
        $data = ['name' => 'Test Country'];

        $response = $this->postJson('/api/countries', $data);
        $response->assertStatus(201)
                 ->assertJsonStructure([
                     'data',
                     'status',
                     'code',
                     'message'
                 ]);

        $this->assertDatabaseHas('countries', $data);
    }

    public function test_can_show_Country(): void
    {
        $Country = Country::factory()->create();

        $response = $this->getJson('/api/countries/' . $Country->id);
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

    public function test_can_update_Country(): void
    {
        $Country = Country::factory()->create();
        $data = ['name' => 'Updated Country'];

        $response = $this->putJson('/api/countries/' . $Country->id, $data);
        $response->assertStatus(200)
                 ->assertJsonStructure([
                     'data',
                     'status',
                     'code',
                     'message'
                 ]);

        $this->assertDatabaseHas('countries', $data);
    }

    public function test_can_delete_Country(): void
    {
        $Country = Country::factory()->create();

        $response = $this->deleteJson('/api/countries/' . $Country->id);
        $response->assertStatus(200)
                 ->assertJsonStructure([
                     'status',
                     'code',
                     'message'
                 ]);

        $this->assertDatabaseMissing('countries', ['id' => $Country->id]);
    }

    public function test_validation_errors_on_create(): void
    {
        $response = $this->postJson('/api/countries', []);
        $response->assertStatus(422)
                 ->assertJsonValidationErrors(['name']);
    }
}
