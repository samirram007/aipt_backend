<?php

namespace App\Modules\Holiday\Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;
use App\Modules\Holiday\Models\Holiday;

class HolidayTest extends TestCase
{
    use RefreshDatabase;

    public function test_can_list_holidays(): void
    {
        $response = $this->getJson('/api/holidays');
        $response->assertStatus(200)
                 ->assertJsonStructure([
                     'data',
                     'status',
                     'code',
                     'message'
                 ]);
    }

    public function test_can_create_Holiday(): void
    {
        $data = ['name' => 'Test Holiday'];

        $response = $this->postJson('/api/holidays', $data);
        $response->assertStatus(201)
                 ->assertJsonStructure([
                     'data',
                     'status',
                     'code',
                     'message'
                 ]);

        $this->assertDatabaseHas('holidays', $data);
    }

    public function test_can_show_Holiday(): void
    {
        $Holiday = Holiday::factory()->create();

        $response = $this->getJson('/api/holidays/' . $Holiday->id);
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

    public function test_can_update_Holiday(): void
    {
        $Holiday = Holiday::factory()->create();
        $data = ['name' => 'Updated Holiday'];

        $response = $this->putJson('/api/holidays/' . $Holiday->id, $data);
        $response->assertStatus(200)
                 ->assertJsonStructure([
                     'data',
                     'status',
                     'code',
                     'message'
                 ]);

        $this->assertDatabaseHas('holidays', $data);
    }

    public function test_can_delete_Holiday(): void
    {
        $Holiday = Holiday::factory()->create();

        $response = $this->deleteJson('/api/holidays/' . $Holiday->id);
        $response->assertStatus(200)
                 ->assertJsonStructure([
                     'status',
                     'code',
                     'message'
                 ]);

        $this->assertDatabaseMissing('holidays', ['id' => $Holiday->id]);
    }

    public function test_validation_errors_on_create(): void
    {
        $response = $this->postJson('/api/holidays', []);
        $response->assertStatus(422)
                 ->assertJsonValidationErrors(['name']);
    }
}
