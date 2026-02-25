<?php

namespace App\Modules\VoucherEntryPurge\Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;
use App\Modules\VoucherEntryPurge\Models\VoucherEntryPurge;

class VoucherEntryPurgeTest extends TestCase
{
    use RefreshDatabase;

    public function test_can_list_voucher_entry_purges(): void
    {
        $response = $this->getJson('/api/voucher_entry_purges');
        $response->assertStatus(200)
                 ->assertJsonStructure([
                     'data',
                     'status',
                     'code',
                     'message'
                 ]);
    }

    public function test_can_create_VoucherEntryPurge(): void
    {
        $data = ['name' => 'Test VoucherEntryPurge'];

        $response = $this->postJson('/api/voucher_entry_purges', $data);
        $response->assertStatus(201)
                 ->assertJsonStructure([
                     'data',
                     'status',
                     'code',
                     'message'
                 ]);

        $this->assertDatabaseHas('voucher_entry_purges', $data);
    }

    public function test_can_show_VoucherEntryPurge(): void
    {
        $VoucherEntryPurge = VoucherEntryPurge::factory()->create();

        $response = $this->getJson('/api/voucher_entry_purges/' . $VoucherEntryPurge->id);
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

    public function test_can_update_VoucherEntryPurge(): void
    {
        $VoucherEntryPurge = VoucherEntryPurge::factory()->create();
        $data = ['name' => 'Updated VoucherEntryPurge'];

        $response = $this->putJson('/api/voucher_entry_purges/' . $VoucherEntryPurge->id, $data);
        $response->assertStatus(200)
                 ->assertJsonStructure([
                     'data',
                     'status',
                     'code',
                     'message'
                 ]);

        $this->assertDatabaseHas('voucher_entry_purges', $data);
    }

    public function test_can_delete_VoucherEntryPurge(): void
    {
        $VoucherEntryPurge = VoucherEntryPurge::factory()->create();

        $response = $this->deleteJson('/api/voucher_entry_purges/' . $VoucherEntryPurge->id);
        $response->assertStatus(200)
                 ->assertJsonStructure([
                     'status',
                     'code',
                     'message'
                 ]);

        $this->assertDatabaseMissing('voucher_entry_purges', ['id' => $VoucherEntryPurge->id]);
    }

    public function test_validation_errors_on_create(): void
    {
        $response = $this->postJson('/api/voucher_entry_purges', []);
        $response->assertStatus(422)
                 ->assertJsonValidationErrors(['name']);
    }
}
