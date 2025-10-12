<?php

namespace App\Modules\Shift\Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;
use App\Modules\Shift\Models\Shift;

class ShiftTest extends TestCase
{
    use RefreshDatabase;

    public function test_can_list_shifts(): void
    {
        $response = $this->getJson('/api/shifts');
        $response->assertStatus(200)
                 ->assertJsonStructure([
                     'data',
                     'status',
                     'code',
                     'message'
                 ]);
    }

    public function test_can_create_Shift(): void
    {
        $data = ['name' => 'Test Shift'];

        $response = $this->postJson('/api/shifts', $data);
        $response->assertStatus(201)
                 ->assertJsonStructure([
                     'data',
                     'status',
                     'code',
                     'message'
                 ]);

        $this->assertDatabaseHas('shifts', $data);
    }

    public function test_can_show_Shift(): void
    {
        $Shift = Shift::factory()->create();

        $response = $this->getJson('/api/shifts/' . $Shift->id);
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

    public function test_can_update_Shift(): void
    {
        $Shift = Shift::factory()->create();
        $data = ['name' => 'Updated Shift'];

        $response = $this->putJson('/api/shifts/' . $Shift->id, $data);
        $response->assertStatus(200)
                 ->assertJsonStructure([
                     'data',
                     'status',
                     'code',
                     'message'
                 ]);

        $this->assertDatabaseHas('shifts', $data);
    }

    public function test_can_delete_Shift(): void
    {
        $Shift = Shift::factory()->create();

        $response = $this->deleteJson('/api/shifts/' . $Shift->id);
        $response->assertStatus(200)
                 ->assertJsonStructure([
                     'status',
                     'code',
                     'message'
                 ]);

        $this->assertDatabaseMissing('shifts', ['id' => $Shift->id]);
    }

    public function test_validation_errors_on_create(): void
    {
        $response = $this->postJson('/api/shifts', []);
        $response->assertStatus(422)
                 ->assertJsonValidationErrors(['name']);
    }
}
