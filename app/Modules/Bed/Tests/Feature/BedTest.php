<?php

namespace App\Modules\Bed\Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;
use App\Modules\Bed\Models\Bed;

class BedTest extends TestCase
{
    use RefreshDatabase;

    public function test_can_list_beds(): void
    {
        $response = $this->getJson('/api/beds');
        $response->assertStatus(200)
                 ->assertJsonStructure([
                     'data',
                     'status',
                     'code',
                     'message'
                 ]);
    }

    public function test_can_create_Bed(): void
    {
        $data = ['name' => 'Test Bed'];

        $response = $this->postJson('/api/beds', $data);
        $response->assertStatus(201)
                 ->assertJsonStructure([
                     'data',
                     'status',
                     'code',
                     'message'
                 ]);

        $this->assertDatabaseHas('beds', $data);
    }

    public function test_can_show_Bed(): void
    {
        $Bed = Bed::factory()->create();

        $response = $this->getJson('/api/beds/' . $Bed->id);
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

    public function test_can_update_Bed(): void
    {
        $Bed = Bed::factory()->create();
        $data = ['name' => 'Updated Bed'];

        $response = $this->putJson('/api/beds/' . $Bed->id, $data);
        $response->assertStatus(200)
                 ->assertJsonStructure([
                     'data',
                     'status',
                     'code',
                     'message'
                 ]);

        $this->assertDatabaseHas('beds', $data);
    }

    public function test_can_delete_Bed(): void
    {
        $Bed = Bed::factory()->create();

        $response = $this->deleteJson('/api/beds/' . $Bed->id);
        $response->assertStatus(200)
                 ->assertJsonStructure([
                     'status',
                     'code',
                     'message'
                 ]);

        $this->assertDatabaseMissing('beds', ['id' => $Bed->id]);
    }

    public function test_validation_errors_on_create(): void
    {
        $response = $this->postJson('/api/beds', []);
        $response->assertStatus(422)
                 ->assertJsonValidationErrors(['name']);
    }
}
