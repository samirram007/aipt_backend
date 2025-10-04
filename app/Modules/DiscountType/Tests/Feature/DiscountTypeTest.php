<?php

namespace App\Modules\DiscountType\Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;
use App\Modules\DiscountType\Models\DiscountType;

class DiscountTypeTest extends TestCase
{
    use RefreshDatabase;

    public function test_can_list_discount_types(): void
    {
        $response = $this->getJson('/api/discount_types');
        $response->assertStatus(200)
                 ->assertJsonStructure([
                     'data',
                     'status',
                     'code',
                     'message'
                 ]);
    }

    public function test_can_create_DiscountType(): void
    {
        $data = ['name' => 'Test DiscountType'];

        $response = $this->postJson('/api/discount_types', $data);
        $response->assertStatus(201)
                 ->assertJsonStructure([
                     'data',
                     'status',
                     'code',
                     'message'
                 ]);

        $this->assertDatabaseHas('discount_types', $data);
    }

    public function test_can_show_DiscountType(): void
    {
        $DiscountType = DiscountType::factory()->create();

        $response = $this->getJson('/api/discount_types/' . $DiscountType->id);
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

    public function test_can_update_DiscountType(): void
    {
        $DiscountType = DiscountType::factory()->create();
        $data = ['name' => 'Updated DiscountType'];

        $response = $this->putJson('/api/discount_types/' . $DiscountType->id, $data);
        $response->assertStatus(200)
                 ->assertJsonStructure([
                     'data',
                     'status',
                     'code',
                     'message'
                 ]);

        $this->assertDatabaseHas('discount_types', $data);
    }

    public function test_can_delete_DiscountType(): void
    {
        $DiscountType = DiscountType::factory()->create();

        $response = $this->deleteJson('/api/discount_types/' . $DiscountType->id);
        $response->assertStatus(200)
                 ->assertJsonStructure([
                     'status',
                     'code',
                     'message'
                 ]);

        $this->assertDatabaseMissing('discount_types', ['id' => $DiscountType->id]);
    }

    public function test_validation_errors_on_create(): void
    {
        $response = $this->postJson('/api/discount_types', []);
        $response->assertStatus(422)
                 ->assertJsonValidationErrors(['name']);
    }
}
