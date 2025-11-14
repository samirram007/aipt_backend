<?php

namespace App\Modules\VoucherNo\Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;
use App\Modules\VoucherNo\Models\VoucherNo;

class VoucherNoTest extends TestCase
{
    use RefreshDatabase;

    public function test_can_list_voucher_nos(): void
    {
        $response = $this->getJson('/api/voucher_nos');
        $response->assertStatus(200)
                 ->assertJsonStructure([
                     'data',
                     'status',
                     'code',
                     'message'
                 ]);
    }

    public function test_can_create_VoucherNo(): void
    {
        $data = ['name' => 'Test VoucherNo'];

        $response = $this->postJson('/api/voucher_nos', $data);
        $response->assertStatus(201)
                 ->assertJsonStructure([
                     'data',
                     'status',
                     'code',
                     'message'
                 ]);

        $this->assertDatabaseHas('voucher_nos', $data);
    }

    public function test_can_show_VoucherNo(): void
    {
        $VoucherNo = VoucherNo::factory()->create();

        $response = $this->getJson('/api/voucher_nos/' . $VoucherNo->id);
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

    public function test_can_update_VoucherNo(): void
    {
        $VoucherNo = VoucherNo::factory()->create();
        $data = ['name' => 'Updated VoucherNo'];

        $response = $this->putJson('/api/voucher_nos/' . $VoucherNo->id, $data);
        $response->assertStatus(200)
                 ->assertJsonStructure([
                     'data',
                     'status',
                     'code',
                     'message'
                 ]);

        $this->assertDatabaseHas('voucher_nos', $data);
    }

    public function test_can_delete_VoucherNo(): void
    {
        $VoucherNo = VoucherNo::factory()->create();

        $response = $this->deleteJson('/api/voucher_nos/' . $VoucherNo->id);
        $response->assertStatus(200)
                 ->assertJsonStructure([
                     'status',
                     'code',
                     'message'
                 ]);

        $this->assertDatabaseMissing('voucher_nos', ['id' => $VoucherNo->id]);
    }

    public function test_validation_errors_on_create(): void
    {
        $response = $this->postJson('/api/voucher_nos', []);
        $response->assertStatus(422)
                 ->assertJsonValidationErrors(['name']);
    }
}
