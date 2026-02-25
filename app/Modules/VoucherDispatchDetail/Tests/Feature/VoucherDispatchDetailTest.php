<?php

namespace App\Modules\VoucherDispatchDetail\Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;
use App\Modules\VoucherDispatchDetail\Models\VoucherDispatchDetail;

class VoucherDispatchDetailTest extends TestCase
{
    use RefreshDatabase;

    public function test_can_list_voucher_dispatch_details(): void
    {
        $response = $this->getJson('/api/voucher_dispatch_details');
        $response->assertStatus(200)
                 ->assertJsonStructure([
                     'data',
                     'status',
                     'code',
                     'message'
                 ]);
    }

    public function test_can_create_VoucherDispatchDetail(): void
    {
        $data = ['name' => 'Test VoucherDispatchDetail'];

        $response = $this->postJson('/api/voucher_dispatch_details', $data);
        $response->assertStatus(201)
                 ->assertJsonStructure([
                     'data',
                     'status',
                     'code',
                     'message'
                 ]);

        $this->assertDatabaseHas('voucher_dispatch_details', $data);
    }

    public function test_can_show_VoucherDispatchDetail(): void
    {
        $VoucherDispatchDetail = VoucherDispatchDetail::factory()->create();

        $response = $this->getJson('/api/voucher_dispatch_details/' . $VoucherDispatchDetail->id);
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

    public function test_can_update_VoucherDispatchDetail(): void
    {
        $VoucherDispatchDetail = VoucherDispatchDetail::factory()->create();
        $data = ['name' => 'Updated VoucherDispatchDetail'];

        $response = $this->putJson('/api/voucher_dispatch_details/' . $VoucherDispatchDetail->id, $data);
        $response->assertStatus(200)
                 ->assertJsonStructure([
                     'data',
                     'status',
                     'code',
                     'message'
                 ]);

        $this->assertDatabaseHas('voucher_dispatch_details', $data);
    }

    public function test_can_delete_VoucherDispatchDetail(): void
    {
        $VoucherDispatchDetail = VoucherDispatchDetail::factory()->create();

        $response = $this->deleteJson('/api/voucher_dispatch_details/' . $VoucherDispatchDetail->id);
        $response->assertStatus(200)
                 ->assertJsonStructure([
                     'status',
                     'code',
                     'message'
                 ]);

        $this->assertDatabaseMissing('voucher_dispatch_details', ['id' => $VoucherDispatchDetail->id]);
    }

    public function test_validation_errors_on_create(): void
    {
        $response = $this->postJson('/api/voucher_dispatch_details', []);
        $response->assertStatus(422)
                 ->assertJsonValidationErrors(['name']);
    }
}
