<?php

namespace App\Modules\Designation\Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;
use App\Modules\Designation\Models\Designation;

class DesignationTest extends TestCase
{
    use RefreshDatabase;

    public function test_can_list_designations(): void
    {
        $response = $this->getJson('/api/designations');
        $response->assertStatus(200)
                 ->assertJsonStructure([
                     'data',
                     'status',
                     'code',
                     'message'
                 ]);
    }

    public function test_can_create_Designation(): void
    {
        $data = ['name' => 'Test Designation'];

        $response = $this->postJson('/api/designations', $data);
        $response->assertStatus(201)
                 ->assertJsonStructure([
                     'data',
                     'status',
                     'code',
                     'message'
                 ]);

        $this->assertDatabaseHas('designations', $data);
    }

    public function test_can_show_Designation(): void
    {
        $Designation = Designation::factory()->create();

        $response = $this->getJson('/api/designations/' . $Designation->id);
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

    public function test_can_update_Designation(): void
    {
        $Designation = Designation::factory()->create();
        $data = ['name' => 'Updated Designation'];

        $response = $this->putJson('/api/designations/' . $Designation->id, $data);
        $response->assertStatus(200)
                 ->assertJsonStructure([
                     'data',
                     'status',
                     'code',
                     'message'
                 ]);

        $this->assertDatabaseHas('designations', $data);
    }

    public function test_can_delete_Designation(): void
    {
        $Designation = Designation::factory()->create();

        $response = $this->deleteJson('/api/designations/' . $Designation->id);
        $response->assertStatus(200)
                 ->assertJsonStructure([
                     'status',
                     'code',
                     'message'
                 ]);

        $this->assertDatabaseMissing('designations', ['id' => $Designation->id]);
    }

    public function test_validation_errors_on_create(): void
    {
        $response = $this->postJson('/api/designations', []);
        $response->assertStatus(422)
                 ->assertJsonValidationErrors(['name']);
    }
}
