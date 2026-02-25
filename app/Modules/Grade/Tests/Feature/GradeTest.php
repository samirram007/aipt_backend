<?php

namespace App\Modules\Grade\Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;
use App\Modules\Grade\Models\Grade;

class GradeTest extends TestCase
{
    use RefreshDatabase;

    public function test_can_list_grades(): void
    {
        $response = $this->getJson('/api/grades');
        $response->assertStatus(200)
                 ->assertJsonStructure([
                     'data',
                     'status',
                     'code',
                     'message'
                 ]);
    }

    public function test_can_create_Grade(): void
    {
        $data = ['name' => 'Test Grade'];

        $response = $this->postJson('/api/grades', $data);
        $response->assertStatus(201)
                 ->assertJsonStructure([
                     'data',
                     'status',
                     'code',
                     'message'
                 ]);

        $this->assertDatabaseHas('grades', $data);
    }

    public function test_can_show_Grade(): void
    {
        $Grade = Grade::factory()->create();

        $response = $this->getJson('/api/grades/' . $Grade->id);
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

    public function test_can_update_Grade(): void
    {
        $Grade = Grade::factory()->create();
        $data = ['name' => 'Updated Grade'];

        $response = $this->putJson('/api/grades/' . $Grade->id, $data);
        $response->assertStatus(200)
                 ->assertJsonStructure([
                     'data',
                     'status',
                     'code',
                     'message'
                 ]);

        $this->assertDatabaseHas('grades', $data);
    }

    public function test_can_delete_Grade(): void
    {
        $Grade = Grade::factory()->create();

        $response = $this->deleteJson('/api/grades/' . $Grade->id);
        $response->assertStatus(200)
                 ->assertJsonStructure([
                     'status',
                     'code',
                     'message'
                 ]);

        $this->assertDatabaseMissing('grades', ['id' => $Grade->id]);
    }

    public function test_validation_errors_on_create(): void
    {
        $response = $this->postJson('/api/grades', []);
        $response->assertStatus(422)
                 ->assertJsonValidationErrors(['name']);
    }
}
