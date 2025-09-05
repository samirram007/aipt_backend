<?php

namespace App\Modules\Unit\Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;
use App\Modules\Unit\Models\Unit;

class UnitTest extends TestCase
{
    use RefreshDatabase;

    public function test_can_list_units(): void
    {
        $response = $this->getJson('/api/units');
        $response->assertStatus(200)
                 ->assertJsonStructure([
                     'data',
                     'status',
                     'code',
                     'message'
                 ]);
    }

    public function test_can_create_Unit(): void
    {
        $data = ['name' => 'Test Unit'];

        $response = $this->postJson('/api/units', $data);
        $response->assertStatus(201)
                 ->assertJsonStructure([
                     'data',
                     'status',
                     'code',
                     'message'
                 ]);

        $this->assertDatabaseHas('units', $data);
    }

    public function test_can_show_Unit(): void
    {
        $Unit = Unit::factory()->create();

        $response = $this->getJson('/api/units/' . $Unit->id);
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

    public function test_can_update_Unit(): void
    {
        $Unit = Unit::factory()->create();
        $data = ['name' => 'Updated Unit'];

        $response = $this->putJson('/api/units/' . $Unit->id, $data);
        $response->assertStatus(200)
                 ->assertJsonStructure([
                     'data',
                     'status',
                     'code',
                     'message'
                 ]);

        $this->assertDatabaseHas('units', $data);
    }

    public function test_can_delete_Unit(): void
    {
        $Unit = Unit::factory()->create();

        $response = $this->deleteJson('/api/units/' . $Unit->id);
        $response->assertStatus(200)
                 ->assertJsonStructure([
                     'status',
                     'code',
                     'message'
                 ]);

        $this->assertDatabaseMissing('units', ['id' => $Unit->id]);
    }

    public function test_validation_errors_on_create(): void
    {
        $response = $this->postJson('/api/units', []);
        $response->assertStatus(422)
                 ->assertJsonValidationErrors(['name']);
    }
}
