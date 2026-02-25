<?php

namespace App\Modules\Freight\Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;
use App\Modules\Freight\Models\Freight;

class FreightTest extends TestCase
{
    use RefreshDatabase;

    public function test_can_list_freights(): void
    {
        $response = $this->getJson('/api/freights');
        $response->assertStatus(200)
                 ->assertJsonStructure([
                     'data',
                     'status',
                     'code',
                     'message'
                 ]);
    }

    public function test_can_create_Freight(): void
    {
        $data = ['name' => 'Test Freight'];

        $response = $this->postJson('/api/freights', $data);
        $response->assertStatus(201)
                 ->assertJsonStructure([
                     'data',
                     'status',
                     'code',
                     'message'
                 ]);

        $this->assertDatabaseHas('freights', $data);
    }

    public function test_can_show_Freight(): void
    {
        $Freight = Freight::factory()->create();

        $response = $this->getJson('/api/freights/' . $Freight->id);
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

    public function test_can_update_Freight(): void
    {
        $Freight = Freight::factory()->create();
        $data = ['name' => 'Updated Freight'];

        $response = $this->putJson('/api/freights/' . $Freight->id, $data);
        $response->assertStatus(200)
                 ->assertJsonStructure([
                     'data',
                     'status',
                     'code',
                     'message'
                 ]);

        $this->assertDatabaseHas('freights', $data);
    }

    public function test_can_delete_Freight(): void
    {
        $Freight = Freight::factory()->create();

        $response = $this->deleteJson('/api/freights/' . $Freight->id);
        $response->assertStatus(200)
                 ->assertJsonStructure([
                     'status',
                     'code',
                     'message'
                 ]);

        $this->assertDatabaseMissing('freights', ['id' => $Freight->id]);
    }

    public function test_validation_errors_on_create(): void
    {
        $response = $this->postJson('/api/freights', []);
        $response->assertStatus(422)
                 ->assertJsonValidationErrors(['name']);
    }
}
