<?php

namespace App\Modules\VoucherPaymentMode\Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;
use App\Modules\VoucherPaymentMode\Models\VoucherPaymentMode;

class VoucherPaymentModeTest extends TestCase
{
    use RefreshDatabase;

    public function test_can_list_voucher_payment_modes(): void
    {
        $response = $this->getJson('/api/voucher_payment_modes');
        $response->assertStatus(200)
                 ->assertJsonStructure([
                     'data',
                     'status',
                     'code',
                     'message'
                 ]);
    }

    public function test_can_create_VoucherPaymentMode(): void
    {
        $data = ['name' => 'Test VoucherPaymentMode'];

        $response = $this->postJson('/api/voucher_payment_modes', $data);
        $response->assertStatus(201)
                 ->assertJsonStructure([
                     'data',
                     'status',
                     'code',
                     'message'
                 ]);

        $this->assertDatabaseHas('voucher_payment_modes', $data);
    }

    public function test_can_show_VoucherPaymentMode(): void
    {
        $VoucherPaymentMode = VoucherPaymentMode::factory()->create();

        $response = $this->getJson('/api/voucher_payment_modes/' . $VoucherPaymentMode->id);
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

    public function test_can_update_VoucherPaymentMode(): void
    {
        $VoucherPaymentMode = VoucherPaymentMode::factory()->create();
        $data = ['name' => 'Updated VoucherPaymentMode'];

        $response = $this->putJson('/api/voucher_payment_modes/' . $VoucherPaymentMode->id, $data);
        $response->assertStatus(200)
                 ->assertJsonStructure([
                     'data',
                     'status',
                     'code',
                     'message'
                 ]);

        $this->assertDatabaseHas('voucher_payment_modes', $data);
    }

    public function test_can_delete_VoucherPaymentMode(): void
    {
        $VoucherPaymentMode = VoucherPaymentMode::factory()->create();

        $response = $this->deleteJson('/api/voucher_payment_modes/' . $VoucherPaymentMode->id);
        $response->assertStatus(200)
                 ->assertJsonStructure([
                     'status',
                     'code',
                     'message'
                 ]);

        $this->assertDatabaseMissing('voucher_payment_modes', ['id' => $VoucherPaymentMode->id]);
    }

    public function test_validation_errors_on_create(): void
    {
        $response = $this->postJson('/api/voucher_payment_modes', []);
        $response->assertStatus(422)
                 ->assertJsonValidationErrors(['name']);
    }
}
