<?php

namespace App\Modules\PaymentMode\Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;
use App\Modules\PaymentMode\Models\PaymentMode;

class PaymentModeTest extends TestCase
{
    use RefreshDatabase;

    public function test_can_list_payment_modes(): void
    {
        $response = $this->getJson('/api/payment_modes');
        $response->assertStatus(200)
                 ->assertJsonStructure([
                     'data',
                     'status',
                     'code',
                     'message'
                 ]);
    }

    public function test_can_create_PaymentMode(): void
    {
        $data = ['name' => 'Test PaymentMode'];

        $response = $this->postJson('/api/payment_modes', $data);
        $response->assertStatus(201)
                 ->assertJsonStructure([
                     'data',
                     'status',
                     'code',
                     'message'
                 ]);

        $this->assertDatabaseHas('payment_modes', $data);
    }

    public function test_can_show_PaymentMode(): void
    {
        $PaymentMode = PaymentMode::factory()->create();

        $response = $this->getJson('/api/payment_modes/' . $PaymentMode->id);
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

    public function test_can_update_PaymentMode(): void
    {
        $PaymentMode = PaymentMode::factory()->create();
        $data = ['name' => 'Updated PaymentMode'];

        $response = $this->putJson('/api/payment_modes/' . $PaymentMode->id, $data);
        $response->assertStatus(200)
                 ->assertJsonStructure([
                     'data',
                     'status',
                     'code',
                     'message'
                 ]);

        $this->assertDatabaseHas('payment_modes', $data);
    }

    public function test_can_delete_PaymentMode(): void
    {
        $PaymentMode = PaymentMode::factory()->create();

        $response = $this->deleteJson('/api/payment_modes/' . $PaymentMode->id);
        $response->assertStatus(200)
                 ->assertJsonStructure([
                     'status',
                     'code',
                     'message'
                 ]);

        $this->assertDatabaseMissing('payment_modes', ['id' => $PaymentMode->id]);
    }

    public function test_validation_errors_on_create(): void
    {
        $response = $this->postJson('/api/payment_modes', []);
        $response->assertStatus(422)
                 ->assertJsonValidationErrors(['name']);
    }
}
