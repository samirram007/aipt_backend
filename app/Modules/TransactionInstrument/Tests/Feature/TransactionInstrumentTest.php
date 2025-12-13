<?php

namespace App\Modules\TransactionInstrument\Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;
use App\Modules\TransactionInstrument\Models\TransactionInstrument;

class TransactionInstrumentTest extends TestCase
{
    use RefreshDatabase;

    public function test_can_list_transaction_instruments(): void
    {
        $response = $this->getJson('/api/transaction_instruments');
        $response->assertStatus(200)
                 ->assertJsonStructure([
                     'data',
                     'status',
                     'code',
                     'message'
                 ]);
    }

    public function test_can_create_TransactionInstrument(): void
    {
        $data = ['name' => 'Test TransactionInstrument'];

        $response = $this->postJson('/api/transaction_instruments', $data);
        $response->assertStatus(201)
                 ->assertJsonStructure([
                     'data',
                     'status',
                     'code',
                     'message'
                 ]);

        $this->assertDatabaseHas('transaction_instruments', $data);
    }

    public function test_can_show_TransactionInstrument(): void
    {
        $TransactionInstrument = TransactionInstrument::factory()->create();

        $response = $this->getJson('/api/transaction_instruments/' . $TransactionInstrument->id);
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

    public function test_can_update_TransactionInstrument(): void
    {
        $TransactionInstrument = TransactionInstrument::factory()->create();
        $data = ['name' => 'Updated TransactionInstrument'];

        $response = $this->putJson('/api/transaction_instruments/' . $TransactionInstrument->id, $data);
        $response->assertStatus(200)
                 ->assertJsonStructure([
                     'data',
                     'status',
                     'code',
                     'message'
                 ]);

        $this->assertDatabaseHas('transaction_instruments', $data);
    }

    public function test_can_delete_TransactionInstrument(): void
    {
        $TransactionInstrument = TransactionInstrument::factory()->create();

        $response = $this->deleteJson('/api/transaction_instruments/' . $TransactionInstrument->id);
        $response->assertStatus(200)
                 ->assertJsonStructure([
                     'status',
                     'code',
                     'message'
                 ]);

        $this->assertDatabaseMissing('transaction_instruments', ['id' => $TransactionInstrument->id]);
    }

    public function test_validation_errors_on_create(): void
    {
        $response = $this->postJson('/api/transaction_instruments', []);
        $response->assertStatus(422)
                 ->assertJsonValidationErrors(['name']);
    }
}
