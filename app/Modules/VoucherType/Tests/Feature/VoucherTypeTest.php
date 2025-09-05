<?php

namespace App\Modules\VoucherType\Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;
use App\Modules\VoucherType\Models\VoucherType;

class VoucherTypeTest extends TestCase
{
    use RefreshDatabase;

    public function test_can_list_voucher_types(): void
    {
        $response = $this->getJson('/api/voucher_types');
        $response->assertStatus(200)
                 ->assertJsonStructure([
                     'data',
                     'status',
                     'code',
                     'message'
                 ]);
    }

    public function test_can_create_VoucherType(): void
    {
        $data = ['name' => 'Test VoucherType'];

        $response = $this->postJson('/api/voucher_types', $data);
        $response->assertStatus(201)
                 ->assertJsonStructure([
                     'data',
                     'status',
                     'code',
                     'message'
                 ]);

        $this->assertDatabaseHas('voucher_types', $data);
    }

    public function test_can_show_VoucherType(): void
    {
        $VoucherType = VoucherType::factory()->create();

        $response = $this->getJson('/api/voucher_types/' . $VoucherType->id);
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

    public function test_can_update_VoucherType(): void
    {
        $VoucherType = VoucherType::factory()->create();
        $data = ['name' => 'Updated VoucherType'];

        $response = $this->putJson('/api/voucher_types/' . $VoucherType->id, $data);
        $response->assertStatus(200)
                 ->assertJsonStructure([
                     'data',
                     'status',
                     'code',
                     'message'
                 ]);

        $this->assertDatabaseHas('voucher_types', $data);
    }

    public function test_can_delete_VoucherType(): void
    {
        $VoucherType = VoucherType::factory()->create();

        $response = $this->deleteJson('/api/voucher_types/' . $VoucherType->id);
        $response->assertStatus(200)
                 ->assertJsonStructure([
                     'status',
                     'code',
                     'message'
                 ]);

        $this->assertDatabaseMissing('voucher_types', ['id' => $VoucherType->id]);
    }

    public function test_validation_errors_on_create(): void
    {
        $response = $this->postJson('/api/voucher_types', []);
        $response->assertStatus(422)
                 ->assertJsonValidationErrors(['name']);
    }
}
