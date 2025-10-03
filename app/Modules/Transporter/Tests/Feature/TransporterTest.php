<?php

namespace App\Modules\Transporter\Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;
use App\Modules\Transporter\Models\Transporter;

class TransporterTest extends TestCase
{
    use RefreshDatabase;

    public function test_can_list_transporters(): void
    {
        $response = $this->getJson('/api/transporters');
        $response->assertStatus(200)
                 ->assertJsonStructure([
                     'data',
                     'status',
                     'code',
                     'message'
                 ]);
    }

    public function test_can_create_Transporter(): void
    {
        $data = ['name' => 'Test Transporter'];

        $response = $this->postJson('/api/transporters', $data);
        $response->assertStatus(201)
                 ->assertJsonStructure([
                     'data',
                     'status',
                     'code',
                     'message'
                 ]);

        $this->assertDatabaseHas('transporters', $data);
    }

    public function test_can_show_Transporter(): void
    {
        $Transporter = Transporter::factory()->create();

        $response = $this->getJson('/api/transporters/' . $Transporter->id);
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

    public function test_can_update_Transporter(): void
    {
        $Transporter = Transporter::factory()->create();
        $data = ['name' => 'Updated Transporter'];

        $response = $this->putJson('/api/transporters/' . $Transporter->id, $data);
        $response->assertStatus(200)
                 ->assertJsonStructure([
                     'data',
                     'status',
                     'code',
                     'message'
                 ]);

        $this->assertDatabaseHas('transporters', $data);
    }

    public function test_can_delete_Transporter(): void
    {
        $Transporter = Transporter::factory()->create();

        $response = $this->deleteJson('/api/transporters/' . $Transporter->id);
        $response->assertStatus(200)
                 ->assertJsonStructure([
                     'status',
                     'code',
                     'message'
                 ]);

        $this->assertDatabaseMissing('transporters', ['id' => $Transporter->id]);
    }

    public function test_validation_errors_on_create(): void
    {
        $response = $this->postJson('/api/transporters', []);
        $response->assertStatus(422)
                 ->assertJsonValidationErrors(['name']);
    }
}
