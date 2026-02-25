<?php

namespace App\Modules\VoucherParty\Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;
use App\Modules\VoucherParty\Models\VoucherParty;

class VoucherPartyTest extends TestCase
{
    use RefreshDatabase;

    public function test_can_list_voucher_parties(): void
    {
        $response = $this->getJson('/api/voucher_parties');
        $response->assertStatus(200)
                 ->assertJsonStructure([
                     'data',
                     'status',
                     'code',
                     'message'
                 ]);
    }

    public function test_can_create_VoucherParty(): void
    {
        $data = ['name' => 'Test VoucherParty'];

        $response = $this->postJson('/api/voucher_parties', $data);
        $response->assertStatus(201)
                 ->assertJsonStructure([
                     'data',
                     'status',
                     'code',
                     'message'
                 ]);

        $this->assertDatabaseHas('voucher_parties', $data);
    }

    public function test_can_show_VoucherParty(): void
    {
        $VoucherParty = VoucherParty::factory()->create();

        $response = $this->getJson('/api/voucher_parties/' . $VoucherParty->id);
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

    public function test_can_update_VoucherParty(): void
    {
        $VoucherParty = VoucherParty::factory()->create();
        $data = ['name' => 'Updated VoucherParty'];

        $response = $this->putJson('/api/voucher_parties/' . $VoucherParty->id, $data);
        $response->assertStatus(200)
                 ->assertJsonStructure([
                     'data',
                     'status',
                     'code',
                     'message'
                 ]);

        $this->assertDatabaseHas('voucher_parties', $data);
    }

    public function test_can_delete_VoucherParty(): void
    {
        $VoucherParty = VoucherParty::factory()->create();

        $response = $this->deleteJson('/api/voucher_parties/' . $VoucherParty->id);
        $response->assertStatus(200)
                 ->assertJsonStructure([
                     'status',
                     'code',
                     'message'
                 ]);

        $this->assertDatabaseMissing('voucher_parties', ['id' => $VoucherParty->id]);
    }

    public function test_validation_errors_on_create(): void
    {
        $response = $this->postJson('/api/voucher_parties', []);
        $response->assertStatus(422)
                 ->assertJsonValidationErrors(['name']);
    }
}
