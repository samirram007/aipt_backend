<?php

namespace App\Modules\Distributor\Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;
use App\Modules\Distributor\Models\Distributor;

class DistributorTest extends TestCase
{
    use RefreshDatabase;

    public function test_can_list_distributors(): void
    {
        $response = $this->getJson('/api/distributors');
        $response->assertStatus(200)
                 ->assertJsonStructure([
                     'data',
                     'status',
                     'code',
                     'message'
                 ]);
    }

    public function test_can_create_Distributor(): void
    {
        $data = ['name' => 'Test Distributor'];

        $response = $this->postJson('/api/distributors', $data);
        $response->assertStatus(201)
                 ->assertJsonStructure([
                     'data',
                     'status',
                     'code',
                     'message'
                 ]);

        $this->assertDatabaseHas('distributors', $data);
    }

    public function test_can_show_Distributor(): void
    {
        $Distributor = Distributor::factory()->create();

        $response = $this->getJson('/api/distributors/' . $Distributor->id);
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

    public function test_can_update_Distributor(): void
    {
        $Distributor = Distributor::factory()->create();
        $data = ['name' => 'Updated Distributor'];

        $response = $this->putJson('/api/distributors/' . $Distributor->id, $data);
        $response->assertStatus(200)
                 ->assertJsonStructure([
                     'data',
                     'status',
                     'code',
                     'message'
                 ]);

        $this->assertDatabaseHas('distributors', $data);
    }

    public function test_can_delete_Distributor(): void
    {
        $Distributor = Distributor::factory()->create();

        $response = $this->deleteJson('/api/distributors/' . $Distributor->id);
        $response->assertStatus(200)
                 ->assertJsonStructure([
                     'status',
                     'code',
                     'message'
                 ]);

        $this->assertDatabaseMissing('distributors', ['id' => $Distributor->id]);
    }

    public function test_validation_errors_on_create(): void
    {
        $response = $this->postJson('/api/distributors', []);
        $response->assertStatus(422)
                 ->assertJsonValidationErrors(['name']);
    }
}
