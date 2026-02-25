<?php

namespace App\Modules\Voucher\Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;
use App\Modules\Voucher\Models\Voucher;

class VoucherTest extends TestCase
{
    use RefreshDatabase;

    public function test_can_list_vouchers(): void
    {
        $response = $this->getJson('/api/vouchers');
        $response->assertStatus(200)
                 ->assertJsonStructure([
                     'data',
                     'status',
                     'code',
                     'message'
                 ]);
    }

    public function test_can_create_Voucher(): void
    {
        $data = ['name' => 'Test Voucher'];

        $response = $this->postJson('/api/vouchers', $data);
        $response->assertStatus(201)
                 ->assertJsonStructure([
                     'data',
                     'status',
                     'code',
                     'message'
                 ]);

        $this->assertDatabaseHas('vouchers', $data);
    }

    public function test_can_show_Voucher(): void
    {
        $Voucher = Voucher::factory()->create();

        $response = $this->getJson('/api/vouchers/' . $Voucher->id);
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

    public function test_can_update_Voucher(): void
    {
        $Voucher = Voucher::factory()->create();
        $data = ['name' => 'Updated Voucher'];

        $response = $this->putJson('/api/vouchers/' . $Voucher->id, $data);
        $response->assertStatus(200)
                 ->assertJsonStructure([
                     'data',
                     'status',
                     'code',
                     'message'
                 ]);

        $this->assertDatabaseHas('vouchers', $data);
    }

    public function test_can_delete_Voucher(): void
    {
        $Voucher = Voucher::factory()->create();

        $response = $this->deleteJson('/api/vouchers/' . $Voucher->id);
        $response->assertStatus(200)
                 ->assertJsonStructure([
                     'status',
                     'code',
                     'message'
                 ]);

        $this->assertDatabaseMissing('vouchers', ['id' => $Voucher->id]);
    }

    public function test_validation_errors_on_create(): void
    {
        $response = $this->postJson('/api/vouchers', []);
        $response->assertStatus(422)
                 ->assertJsonValidationErrors(['name']);
    }
}
