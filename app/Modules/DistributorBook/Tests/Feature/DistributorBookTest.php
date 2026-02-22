<?php

namespace App\Modules\DistributorBook\Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;
use App\Modules\DistributorBook\Models\DistributorBook;

class DistributorBookTest extends TestCase
{
    use RefreshDatabase;

    public function test_can_list_distributor_books(): void
    {
        $response = $this->getJson('/api/distributor_books');
        $response->assertStatus(200)
                 ->assertJsonStructure([
                     'data',
                     'status',
                     'code',
                     'message'
                 ]);
    }

    public function test_can_create_DistributorBook(): void
    {
        $data = ['name' => 'Test DistributorBook'];

        $response = $this->postJson('/api/distributor_books', $data);
        $response->assertStatus(201)
                 ->assertJsonStructure([
                     'data',
                     'status',
                     'code',
                     'message'
                 ]);

        $this->assertDatabaseHas('distributor_books', $data);
    }

    public function test_can_show_DistributorBook(): void
    {
        $DistributorBook = DistributorBook::factory()->create();

        $response = $this->getJson('/api/distributor_books/' . $DistributorBook->id);
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

    public function test_can_update_DistributorBook(): void
    {
        $DistributorBook = DistributorBook::factory()->create();
        $data = ['name' => 'Updated DistributorBook'];

        $response = $this->putJson('/api/distributor_books/' . $DistributorBook->id, $data);
        $response->assertStatus(200)
                 ->assertJsonStructure([
                     'data',
                     'status',
                     'code',
                     'message'
                 ]);

        $this->assertDatabaseHas('distributor_books', $data);
    }

    public function test_can_delete_DistributorBook(): void
    {
        $DistributorBook = DistributorBook::factory()->create();

        $response = $this->deleteJson('/api/distributor_books/' . $DistributorBook->id);
        $response->assertStatus(200)
                 ->assertJsonStructure([
                     'status',
                     'code',
                     'message'
                 ]);

        $this->assertDatabaseMissing('distributor_books', ['id' => $DistributorBook->id]);
    }

    public function test_validation_errors_on_create(): void
    {
        $response = $this->postJson('/api/distributor_books', []);
        $response->assertStatus(422)
                 ->assertJsonValidationErrors(['name']);
    }
}
