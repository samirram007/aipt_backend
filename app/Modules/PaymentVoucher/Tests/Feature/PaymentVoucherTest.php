<?php

namespace App\Modules\PaymentVoucher\Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;
use App\Modules\PaymentVoucher\Models\PaymentVoucher;

class PaymentVoucherTest extends TestCase
{
    use RefreshDatabase;

    public function test_can_list_payment_vouchers(): void
    {
        $response = $this->getJson('/api/payment_vouchers');
        $response->assertStatus(200)
                 ->assertJsonStructure([
                     'data',
                     'status',
                     'code',
                     'message'
                 ]);
    }

    public function test_can_create_PaymentVoucher(): void
    {
        $data = ['name' => 'Test PaymentVoucher'];

        $response = $this->postJson('/api/payment_vouchers', $data);
        $response->assertStatus(201)
                 ->assertJsonStructure([
                     'data',
                     'status',
                     'code',
                     'message'
                 ]);

        $this->assertDatabaseHas('payment_vouchers', $data);
    }

    public function test_can_show_PaymentVoucher(): void
    {
        $PaymentVoucher = PaymentVoucher::factory()->create();

        $response = $this->getJson('/api/payment_vouchers/' . $PaymentVoucher->id);
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

    public function test_can_update_PaymentVoucher(): void
    {
        $PaymentVoucher = PaymentVoucher::factory()->create();
        $data = ['name' => 'Updated PaymentVoucher'];

        $response = $this->putJson('/api/payment_vouchers/' . $PaymentVoucher->id, $data);
        $response->assertStatus(200)
                 ->assertJsonStructure([
                     'data',
                     'status',
                     'code',
                     'message'
                 ]);

        $this->assertDatabaseHas('payment_vouchers', $data);
    }

    public function test_can_delete_PaymentVoucher(): void
    {
        $PaymentVoucher = PaymentVoucher::factory()->create();

        $response = $this->deleteJson('/api/payment_vouchers/' . $PaymentVoucher->id);
        $response->assertStatus(200)
                 ->assertJsonStructure([
                     'status',
                     'code',
                     'message'
                 ]);

        $this->assertDatabaseMissing('payment_vouchers', ['id' => $PaymentVoucher->id]);
    }

    public function test_validation_errors_on_create(): void
    {
        $response = $this->postJson('/api/payment_vouchers', []);
        $response->assertStatus(422)
                 ->assertJsonValidationErrors(['name']);
    }
}
