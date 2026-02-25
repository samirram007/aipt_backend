<?php

namespace App\Modules\Vendor\Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;
use App\Modules\Vendor\Models\Vendor;

class VendorTest extends TestCase
{
    use RefreshDatabase;

    public function test_can_list_vendors(): void
    {
        $response = $this->getJson('/api/vendors');
        $response->assertStatus(200)
                 ->assertJsonStructure([
                     'data',
                     'status',
                     'code',
                     'message'
                 ]);
    }

    public function test_can_create_Vendor(): void
    {
        $data = ['name' => 'Test Vendor'];

        $response = $this->postJson('/api/vendors', $data);
        $response->assertStatus(201)
                 ->assertJsonStructure([
                     'data',
                     'status',
                     'code',
                     'message'
                 ]);

        $this->assertDatabaseHas('vendors', $data);
    }

    public function test_can_show_Vendor(): void
    {
        $Vendor = Vendor::factory()->create();

        $response = $this->getJson('/api/vendors/' . $Vendor->id);
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

    public function test_can_update_Vendor(): void
    {
        $Vendor = Vendor::factory()->create();
        $data = ['name' => 'Updated Vendor'];

        $response = $this->putJson('/api/vendors/' . $Vendor->id, $data);
        $response->assertStatus(200)
                 ->assertJsonStructure([
                     'data',
                     'status',
                     'code',
                     'message'
                 ]);

        $this->assertDatabaseHas('vendors', $data);
    }

    public function test_can_delete_Vendor(): void
    {
        $Vendor = Vendor::factory()->create();

        $response = $this->deleteJson('/api/vendors/' . $Vendor->id);
        $response->assertStatus(200)
                 ->assertJsonStructure([
                     'status',
                     'code',
                     'message'
                 ]);

        $this->assertDatabaseMissing('vendors', ['id' => $Vendor->id]);
    }

    public function test_validation_errors_on_create(): void
    {
        $response = $this->postJson('/api/vendors', []);
        $response->assertStatus(422)
                 ->assertJsonValidationErrors(['name']);
    }
}
