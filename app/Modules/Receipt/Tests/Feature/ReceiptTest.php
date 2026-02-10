<?php

namespace App\Modules\Receipt\Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;
use App\Modules\Receipt\Models\Receipt;

class ReceiptTest extends TestCase
{
    use RefreshDatabase;

    public function test_can_list_receipts(): void
    {
        $response = $this->getJson('/api/receipts');
        $response->assertStatus(200)
                 ->assertJsonStructure([
                     'data',
                     'status',
                     'code',
                     'message'
                 ]);
    }

    public function test_can_create_Receipt(): void
    {
        $data = ['name' => 'Test Receipt'];

        $response = $this->postJson('/api/receipts', $data);
        $response->assertStatus(201)
                 ->assertJsonStructure([
                     'data',
                     'status',
                     'code',
                     'message'
                 ]);

        $this->assertDatabaseHas('receipts', $data);
    }

    public function test_can_show_Receipt(): void
    {
        $Receipt = Receipt::factory()->create();

        $response = $this->getJson('/api/receipts/' . $Receipt->id);
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

    public function test_can_update_Receipt(): void
    {
        $Receipt = Receipt::factory()->create();
        $data = ['name' => 'Updated Receipt'];

        $response = $this->putJson('/api/receipts/' . $Receipt->id, $data);
        $response->assertStatus(200)
                 ->assertJsonStructure([
                     'data',
                     'status',
                     'code',
                     'message'
                 ]);

        $this->assertDatabaseHas('receipts', $data);
    }

    public function test_can_delete_Receipt(): void
    {
        $Receipt = Receipt::factory()->create();

        $response = $this->deleteJson('/api/receipts/' . $Receipt->id);
        $response->assertStatus(200)
                 ->assertJsonStructure([
                     'status',
                     'code',
                     'message'
                 ]);

        $this->assertDatabaseMissing('receipts', ['id' => $Receipt->id]);
    }

    public function test_validation_errors_on_create(): void
    {
        $response = $this->postJson('/api/receipts', []);
        $response->assertStatus(422)
                 ->assertJsonValidationErrors(['name']);
    }
}
