<?php

namespace App\Modules\Discipline\Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;
use App\Modules\Discipline\Models\Discipline;

class DisciplineTest extends TestCase
{
    use RefreshDatabase;

    public function test_can_list_disciplines(): void
    {
        $response = $this->getJson('/api/disciplines');
        $response->assertStatus(200)
                 ->assertJsonStructure([
                     'data',
                     'status',
                     'code',
                     'message'
                 ]);
    }

    public function test_can_create_Discipline(): void
    {
        $data = ['name' => 'Test Discipline'];

        $response = $this->postJson('/api/disciplines', $data);
        $response->assertStatus(201)
                 ->assertJsonStructure([
                     'data',
                     'status',
                     'code',
                     'message'
                 ]);

        $this->assertDatabaseHas('disciplines', $data);
    }

    public function test_can_show_Discipline(): void
    {
        $Discipline = Discipline::factory()->create();

        $response = $this->getJson('/api/disciplines/' . $Discipline->id);
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

    public function test_can_update_Discipline(): void
    {
        $Discipline = Discipline::factory()->create();
        $data = ['name' => 'Updated Discipline'];

        $response = $this->putJson('/api/disciplines/' . $Discipline->id, $data);
        $response->assertStatus(200)
                 ->assertJsonStructure([
                     'data',
                     'status',
                     'code',
                     'message'
                 ]);

        $this->assertDatabaseHas('disciplines', $data);
    }

    public function test_can_delete_Discipline(): void
    {
        $Discipline = Discipline::factory()->create();

        $response = $this->deleteJson('/api/disciplines/' . $Discipline->id);
        $response->assertStatus(200)
                 ->assertJsonStructure([
                     'status',
                     'code',
                     'message'
                 ]);

        $this->assertDatabaseMissing('disciplines', ['id' => $Discipline->id]);
    }

    public function test_validation_errors_on_create(): void
    {
        $response = $this->postJson('/api/disciplines', []);
        $response->assertStatus(422)
                 ->assertJsonValidationErrors(['name']);
    }
}
