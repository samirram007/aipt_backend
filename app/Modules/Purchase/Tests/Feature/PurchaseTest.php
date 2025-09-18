<?php

namespace App\Modules\Purchase\Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;
use App\Modules\Purchase\Models\Purchase;

class PurchaseTest extends TestCase
{
    use RefreshDatabase;

    public function test_can_list_purchases(): void
    {
        $response = $this->getJson('/api/purchases');
        $response->assertStatus(200)
                 ->assertJsonStructure([
                     'data',
                     'status',
                     'code',
                     'message'
                 ]);
    }

    public function test_can_create_Purchase(): void
    {
        $data = ['name' => 'Test Purchase'];

        $response = $this->postJson('/api/purchases', $data);
        $response->assertStatus(201)
                 ->assertJsonStructure([
                     'data',
                     'status',
                     'code',
                     'message'
                 ]);

        $this->assertDatabaseHas('purchases', $data);
    }

    public function test_can_show_Purchase(): void
    {
        $Purchase = Purchase::factory()->create();

        $response = $this->getJson('/api/purchases/' . $Purchase->id);
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

    public function test_can_update_Purchase(): void
    {
        $Purchase = Purchase::factory()->create();
        $data = ['name' => 'Updated Purchase'];

        $response = $this->putJson('/api/purchases/' . $Purchase->id, $data);
        $response->assertStatus(200)
                 ->assertJsonStructure([
                     'data',
                     'status',
                     'code',
                     'message'
                 ]);

        $this->assertDatabaseHas('purchases', $data);
    }

    public function test_can_delete_Purchase(): void
    {
        $Purchase = Purchase::factory()->create();

        $response = $this->deleteJson('/api/purchases/' . $Purchase->id);
        $response->assertStatus(200)
                 ->assertJsonStructure([
                     'status',
                     'code',
                     'message'
                 ]);

        $this->assertDatabaseMissing('purchases', ['id' => $Purchase->id]);
    }

    public function test_validation_errors_on_create(): void
    {
        $response = $this->postJson('/api/purchases', []);
        $response->assertStatus(422)
                 ->assertJsonValidationErrors(['name']);
    }
}
