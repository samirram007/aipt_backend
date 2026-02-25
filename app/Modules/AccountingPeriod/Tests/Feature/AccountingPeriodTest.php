<?php

namespace App\Modules\AccountingPeriod\Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;
use App\Modules\AccountingPeriod\Models\AccountingPeriod;

class AccountingPeriodTest extends TestCase
{
    use RefreshDatabase;

    public function test_can_list_accounting_periods(): void
    {
        $response = $this->getJson('/api/accounting_periods');
        $response->assertStatus(200)
                 ->assertJsonStructure([
                     'data',
                     'status',
                     'code',
                     'message'
                 ]);
    }

    public function test_can_create_AccountingPeriod(): void
    {
        $data = ['name' => 'Test AccountingPeriod'];

        $response = $this->postJson('/api/accounting_periods', $data);
        $response->assertStatus(201)
                 ->assertJsonStructure([
                     'data',
                     'status',
                     'code',
                     'message'
                 ]);

        $this->assertDatabaseHas('accounting_periods', $data);
    }

    public function test_can_show_AccountingPeriod(): void
    {
        $AccountingPeriod = AccountingPeriod::factory()->create();

        $response = $this->getJson('/api/accounting_periods/' . $AccountingPeriod->id);
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

    public function test_can_update_AccountingPeriod(): void
    {
        $AccountingPeriod = AccountingPeriod::factory()->create();
        $data = ['name' => 'Updated AccountingPeriod'];

        $response = $this->putJson('/api/accounting_periods/' . $AccountingPeriod->id, $data);
        $response->assertStatus(200)
                 ->assertJsonStructure([
                     'data',
                     'status',
                     'code',
                     'message'
                 ]);

        $this->assertDatabaseHas('accounting_periods', $data);
    }

    public function test_can_delete_AccountingPeriod(): void
    {
        $AccountingPeriod = AccountingPeriod::factory()->create();

        $response = $this->deleteJson('/api/accounting_periods/' . $AccountingPeriod->id);
        $response->assertStatus(200)
                 ->assertJsonStructure([
                     'status',
                     'code',
                     'message'
                 ]);

        $this->assertDatabaseMissing('accounting_periods', ['id' => $AccountingPeriod->id]);
    }

    public function test_validation_errors_on_create(): void
    {
        $response = $this->postJson('/api/accounting_periods', []);
        $response->assertStatus(422)
                 ->assertJsonValidationErrors(['name']);
    }
}
