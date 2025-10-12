<?php

namespace App\Modules\PaymentTransaction\Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;
use App\Modules\PaymentTransaction\Models\PaymentTransaction;

class PaymentTransactionTest extends TestCase
{
    use RefreshDatabase;

    public function test_can_list_payment_transactions(): void
    {
        $response = $this->getJson('/api/payment_transactions');
        $response->assertStatus(200)
                 ->assertJsonStructure([
                     'data',
                     'status',
                     'code',
                     'message'
                 ]);
    }

    public function test_can_create_PaymentTransaction(): void
    {
        $data = ['name' => 'Test PaymentTransaction'];

        $response = $this->postJson('/api/payment_transactions', $data);
        $response->assertStatus(201)
                 ->assertJsonStructure([
                     'data',
                     'status',
                     'code',
                     'message'
                 ]);

        $this->assertDatabaseHas('payment_transactions', $data);
    }

    public function test_can_show_PaymentTransaction(): void
    {
        $PaymentTransaction = PaymentTransaction::factory()->create();

        $response = $this->getJson('/api/payment_transactions/' . $PaymentTransaction->id);
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

    public function test_can_update_PaymentTransaction(): void
    {
        $PaymentTransaction = PaymentTransaction::factory()->create();
        $data = ['name' => 'Updated PaymentTransaction'];

        $response = $this->putJson('/api/payment_transactions/' . $PaymentTransaction->id, $data);
        $response->assertStatus(200)
                 ->assertJsonStructure([
                     'data',
                     'status',
                     'code',
                     'message'
                 ]);

        $this->assertDatabaseHas('payment_transactions', $data);
    }

    public function test_can_delete_PaymentTransaction(): void
    {
        $PaymentTransaction = PaymentTransaction::factory()->create();

        $response = $this->deleteJson('/api/payment_transactions/' . $PaymentTransaction->id);
        $response->assertStatus(200)
                 ->assertJsonStructure([
                     'status',
                     'code',
                     'message'
                 ]);

        $this->assertDatabaseMissing('payment_transactions', ['id' => $PaymentTransaction->id]);
    }

    public function test_validation_errors_on_create(): void
    {
        $response = $this->postJson('/api/payment_transactions', []);
        $response->assertStatus(422)
                 ->assertJsonValidationErrors(['name']);
    }
}
