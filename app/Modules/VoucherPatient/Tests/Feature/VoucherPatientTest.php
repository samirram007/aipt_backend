<?php

namespace App\Modules\VoucherPatient\Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;
use App\Modules\VoucherPatient\Models\VoucherPatient;

class VoucherPatientTest extends TestCase
{
    use RefreshDatabase;

    public function test_can_list_voucher_patients(): void
    {
        $response = $this->getJson('/api/voucher_patients');
        $response->assertStatus(200)
                 ->assertJsonStructure([
                     'data',
                     'status',
                     'code',
                     'message'
                 ]);
    }

    public function test_can_create_VoucherPatient(): void
    {
        $data = ['name' => 'Test VoucherPatient'];

        $response = $this->postJson('/api/voucher_patients', $data);
        $response->assertStatus(201)
                 ->assertJsonStructure([
                     'data',
                     'status',
                     'code',
                     'message'
                 ]);

        $this->assertDatabaseHas('voucher_patients', $data);
    }

    public function test_can_show_VoucherPatient(): void
    {
        $VoucherPatient = VoucherPatient::factory()->create();

        $response = $this->getJson('/api/voucher_patients/' . $VoucherPatient->id);
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

    public function test_can_update_VoucherPatient(): void
    {
        $VoucherPatient = VoucherPatient::factory()->create();
        $data = ['name' => 'Updated VoucherPatient'];

        $response = $this->putJson('/api/voucher_patients/' . $VoucherPatient->id, $data);
        $response->assertStatus(200)
                 ->assertJsonStructure([
                     'data',
                     'status',
                     'code',
                     'message'
                 ]);

        $this->assertDatabaseHas('voucher_patients', $data);
    }

    public function test_can_delete_VoucherPatient(): void
    {
        $VoucherPatient = VoucherPatient::factory()->create();

        $response = $this->deleteJson('/api/voucher_patients/' . $VoucherPatient->id);
        $response->assertStatus(200)
                 ->assertJsonStructure([
                     'status',
                     'code',
                     'message'
                 ]);

        $this->assertDatabaseMissing('voucher_patients', ['id' => $VoucherPatient->id]);
    }

    public function test_validation_errors_on_create(): void
    {
        $response = $this->postJson('/api/voucher_patients', []);
        $response->assertStatus(422)
                 ->assertJsonValidationErrors(['name']);
    }
}
