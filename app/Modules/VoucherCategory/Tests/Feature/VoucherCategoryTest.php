<?php

namespace App\Modules\VoucherCategory\Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;
use App\Modules\VoucherCategory\Models\VoucherCategory;

class VoucherCategoryTest extends TestCase
{
    use RefreshDatabase;

    public function test_can_list_voucher_categories(): void
    {
        $response = $this->getJson('/api/voucher_categories');
        $response->assertStatus(200)
                 ->assertJsonStructure([
                     'data',
                     'status',
                     'code',
                     'message'
                 ]);
    }

    public function test_can_create_VoucherCategory(): void
    {
        $data = ['name' => 'Test VoucherCategory'];

        $response = $this->postJson('/api/voucher_categories', $data);
        $response->assertStatus(201)
                 ->assertJsonStructure([
                     'data',
                     'status',
                     'code',
                     'message'
                 ]);

        $this->assertDatabaseHas('voucher_categories', $data);
    }

    public function test_can_show_VoucherCategory(): void
    {
        $VoucherCategory = VoucherCategory::factory()->create();

        $response = $this->getJson('/api/voucher_categories/' . $VoucherCategory->id);
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

    public function test_can_update_VoucherCategory(): void
    {
        $VoucherCategory = VoucherCategory::factory()->create();
        $data = ['name' => 'Updated VoucherCategory'];

        $response = $this->putJson('/api/voucher_categories/' . $VoucherCategory->id, $data);
        $response->assertStatus(200)
                 ->assertJsonStructure([
                     'data',
                     'status',
                     'code',
                     'message'
                 ]);

        $this->assertDatabaseHas('voucher_categories', $data);
    }

    public function test_can_delete_VoucherCategory(): void
    {
        $VoucherCategory = VoucherCategory::factory()->create();

        $response = $this->deleteJson('/api/voucher_categories/' . $VoucherCategory->id);
        $response->assertStatus(200)
                 ->assertJsonStructure([
                     'status',
                     'code',
                     'message'
                 ]);

        $this->assertDatabaseMissing('voucher_categories', ['id' => $VoucherCategory->id]);
    }

    public function test_validation_errors_on_create(): void
    {
        $response = $this->postJson('/api/voucher_categories', []);
        $response->assertStatus(422)
                 ->assertJsonValidationErrors(['name']);
    }
}
