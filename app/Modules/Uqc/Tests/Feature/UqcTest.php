<?php

namespace App\Modules\Uqc\Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;
use App\Modules\Uqc\Models\Uqc;

class UqcTest extends TestCase
{
    use RefreshDatabase;

    public function test_can_list_uqcs(): void
    {
        $response = $this->getJson('/api/uqcs');
        $response->assertStatus(200)
                 ->assertJsonStructure([
                     'data',
                     'status',
                     'code',
                     'message'
                 ]);
    }

    public function test_can_create_Uqc(): void
    {
        $data = ['name' => 'Test Uqc'];

        $response = $this->postJson('/api/uqcs', $data);
        $response->assertStatus(201)
                 ->assertJsonStructure([
                     'data',
                     'status',
                     'code',
                     'message'
                 ]);

        $this->assertDatabaseHas('uqcs', $data);
    }

    public function test_can_show_Uqc(): void
    {
        $Uqc = Uqc::factory()->create();

        $response = $this->getJson('/api/uqcs/' . $Uqc->id);
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

    public function test_can_update_Uqc(): void
    {
        $Uqc = Uqc::factory()->create();
        $data = ['name' => 'Updated Uqc'];

        $response = $this->putJson('/api/uqcs/' . $Uqc->id, $data);
        $response->assertStatus(200)
                 ->assertJsonStructure([
                     'data',
                     'status',
                     'code',
                     'message'
                 ]);

        $this->assertDatabaseHas('uqcs', $data);
    }

    public function test_can_delete_Uqc(): void
    {
        $Uqc = Uqc::factory()->create();

        $response = $this->deleteJson('/api/uqcs/' . $Uqc->id);
        $response->assertStatus(200)
                 ->assertJsonStructure([
                     'status',
                     'code',
                     'message'
                 ]);

        $this->assertDatabaseMissing('uqcs', ['id' => $Uqc->id]);
    }

    public function test_validation_errors_on_create(): void
    {
        $response = $this->postJson('/api/uqcs', []);
        $response->assertStatus(422)
                 ->assertJsonValidationErrors(['name']);
    }
}
