<?php

namespace App\Modules\ReceiptVoucher\Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;
use App\Modules\ReceiptVoucher\Models\ReceiptVoucher;

class ReceiptVoucherTest extends TestCase
{
    use RefreshDatabase;

    public function test_can_list_receipt_vouchers(): void
    {
        $response = $this->getJson('/api/receipt_vouchers');
        $response->assertStatus(200)
                 ->assertJsonStructure([
                     'data',
                     'status',
                     'code',
                     'message'
                 ]);
    }

    public function test_can_create_ReceiptVoucher(): void
    {
        $data = ['name' => 'Test ReceiptVoucher'];

        $response = $this->postJson('/api/receipt_vouchers', $data);
        $response->assertStatus(201)
                 ->assertJsonStructure([
                     'data',
                     'status',
                     'code',
                     'message'
                 ]);

        $this->assertDatabaseHas('receipt_vouchers', $data);
    }

    public function test_can_show_ReceiptVoucher(): void
    {
        $ReceiptVoucher = ReceiptVoucher::factory()->create();

        $response = $this->getJson('/api/receipt_vouchers/' . $ReceiptVoucher->id);
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

    public function test_can_update_ReceiptVoucher(): void
    {
        $ReceiptVoucher = ReceiptVoucher::factory()->create();
        $data = ['name' => 'Updated ReceiptVoucher'];

        $response = $this->putJson('/api/receipt_vouchers/' . $ReceiptVoucher->id, $data);
        $response->assertStatus(200)
                 ->assertJsonStructure([
                     'data',
                     'status',
                     'code',
                     'message'
                 ]);

        $this->assertDatabaseHas('receipt_vouchers', $data);
    }

    public function test_can_delete_ReceiptVoucher(): void
    {
        $ReceiptVoucher = ReceiptVoucher::factory()->create();

        $response = $this->deleteJson('/api/receipt_vouchers/' . $ReceiptVoucher->id);
        $response->assertStatus(200)
                 ->assertJsonStructure([
                     'status',
                     'code',
                     'message'
                 ]);

        $this->assertDatabaseMissing('receipt_vouchers', ['id' => $ReceiptVoucher->id]);
    }

    public function test_validation_errors_on_create(): void
    {
        $response = $this->postJson('/api/receipt_vouchers', []);
        $response->assertStatus(422)
                 ->assertJsonValidationErrors(['name']);
    }
}
