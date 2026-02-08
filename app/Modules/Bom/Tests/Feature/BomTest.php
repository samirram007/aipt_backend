<?php

namespace App\Modules\Bom\Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;
use App\Modules\Bom\Models\Bom;

class BomTest extends TestCase
{
    use RefreshDatabase;

    public function test_can_list_boms(): void
    {
        $response = $this->getJson('/api/boms');
        $response->assertStatus(200)
                 ->assertJsonStructure([
                     'data',
                     'status',
                     'code',
                     'message'
                 ]);
    }

    public function test_can_create_Bom(): void
    {
        $data = ['name' => 'Test Bom'];

        $response = $this->postJson('/api/boms', $data);
        $response->assertStatus(201)
                 ->assertJsonStructure([
                     'data',
                     'status',
                     'code',
                     'message'
                 ]);

        $this->assertDatabaseHas('boms', $data);
    }

    public function test_can_show_Bom(): void
    {
        $Bom = Bom::factory()->create();

        $response = $this->getJson('/api/boms/' . $Bom->id);
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

    public function test_can_update_Bom(): void
    {
        $Bom = Bom::factory()->create();
        $data = ['name' => 'Updated Bom'];

        $response = $this->putJson('/api/boms/' . $Bom->id, $data);
        $response->assertStatus(200)
                 ->assertJsonStructure([
                     'data',
                     'status',
                     'code',
                     'message'
                 ]);

        $this->assertDatabaseHas('boms', $data);
    }

    public function test_can_delete_Bom(): void
    {
        $Bom = Bom::factory()->create();

        $response = $this->deleteJson('/api/boms/' . $Bom->id);
        $response->assertStatus(200)
                 ->assertJsonStructure([
                     'status',
                     'code',
                     'message'
                 ]);

        $this->assertDatabaseMissing('boms', ['id' => $Bom->id]);
    }

    public function test_validation_errors_on_create(): void
    {
        $response = $this->postJson('/api/boms', []);
        $response->assertStatus(422)
                 ->assertJsonValidationErrors(['name']);
    }
}
