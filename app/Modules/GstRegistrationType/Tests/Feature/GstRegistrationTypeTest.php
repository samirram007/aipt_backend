<?php

namespace App\Modules\GstRegistrationType\Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;
use App\Modules\GstRegistrationType\Models\GstRegistrationType;

class GstRegistrationTypeTest extends TestCase
{
    use RefreshDatabase;

    public function test_can_list_gst_registration_types(): void
    {
        $response = $this->getJson('/api/gst_registration_types');
        $response->assertStatus(200)
                 ->assertJsonStructure([
                     'data',
                     'status',
                     'code',
                     'message'
                 ]);
    }

    public function test_can_create_GstRegistrationType(): void
    {
        $data = ['name' => 'Test GstRegistrationType'];

        $response = $this->postJson('/api/gst_registration_types', $data);
        $response->assertStatus(201)
                 ->assertJsonStructure([
                     'data',
                     'status',
                     'code',
                     'message'
                 ]);

        $this->assertDatabaseHas('gst_registration_types', $data);
    }

    public function test_can_show_GstRegistrationType(): void
    {
        $GstRegistrationType = GstRegistrationType::factory()->create();

        $response = $this->getJson('/api/gst_registration_types/' . $GstRegistrationType->id);
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

    public function test_can_update_GstRegistrationType(): void
    {
        $GstRegistrationType = GstRegistrationType::factory()->create();
        $data = ['name' => 'Updated GstRegistrationType'];

        $response = $this->putJson('/api/gst_registration_types/' . $GstRegistrationType->id, $data);
        $response->assertStatus(200)
                 ->assertJsonStructure([
                     'data',
                     'status',
                     'code',
                     'message'
                 ]);

        $this->assertDatabaseHas('gst_registration_types', $data);
    }

    public function test_can_delete_GstRegistrationType(): void
    {
        $GstRegistrationType = GstRegistrationType::factory()->create();

        $response = $this->deleteJson('/api/gst_registration_types/' . $GstRegistrationType->id);
        $response->assertStatus(200)
                 ->assertJsonStructure([
                     'status',
                     'code',
                     'message'
                 ]);

        $this->assertDatabaseMissing('gst_registration_types', ['id' => $GstRegistrationType->id]);
    }

    public function test_validation_errors_on_create(): void
    {
        $response = $this->postJson('/api/gst_registration_types', []);
        $response->assertStatus(422)
                 ->assertJsonValidationErrors(['name']);
    }
}
