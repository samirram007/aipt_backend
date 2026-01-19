<?php

namespace App\Modules\CapitalItemMaintenanceLog\Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;
use App\Modules\CapitalItemMaintenanceLog\Models\CapitalItemMaintenanceLog;

class CapitalItemMaintenanceLogTest extends TestCase
{
    use RefreshDatabase;

    public function test_can_list_capital_item_maintenance_logs(): void
    {
        $response = $this->getJson('/api/capital_item_maintenance_logs');
        $response->assertStatus(200)
                 ->assertJsonStructure([
                     'data',
                     'status',
                     'code',
                     'message'
                 ]);
    }

    public function test_can_create_CapitalItemMaintenanceLog(): void
    {
        $data = ['name' => 'Test CapitalItemMaintenanceLog'];

        $response = $this->postJson('/api/capital_item_maintenance_logs', $data);
        $response->assertStatus(201)
                 ->assertJsonStructure([
                     'data',
                     'status',
                     'code',
                     'message'
                 ]);

        $this->assertDatabaseHas('capital_item_maintenance_logs', $data);
    }

    public function test_can_show_CapitalItemMaintenanceLog(): void
    {
        $CapitalItemMaintenanceLog = CapitalItemMaintenanceLog::factory()->create();

        $response = $this->getJson('/api/capital_item_maintenance_logs/' . $CapitalItemMaintenanceLog->id);
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

    public function test_can_update_CapitalItemMaintenanceLog(): void
    {
        $CapitalItemMaintenanceLog = CapitalItemMaintenanceLog::factory()->create();
        $data = ['name' => 'Updated CapitalItemMaintenanceLog'];

        $response = $this->putJson('/api/capital_item_maintenance_logs/' . $CapitalItemMaintenanceLog->id, $data);
        $response->assertStatus(200)
                 ->assertJsonStructure([
                     'data',
                     'status',
                     'code',
                     'message'
                 ]);

        $this->assertDatabaseHas('capital_item_maintenance_logs', $data);
    }

    public function test_can_delete_CapitalItemMaintenanceLog(): void
    {
        $CapitalItemMaintenanceLog = CapitalItemMaintenanceLog::factory()->create();

        $response = $this->deleteJson('/api/capital_item_maintenance_logs/' . $CapitalItemMaintenanceLog->id);
        $response->assertStatus(200)
                 ->assertJsonStructure([
                     'status',
                     'code',
                     'message'
                 ]);

        $this->assertDatabaseMissing('capital_item_maintenance_logs', ['id' => $CapitalItemMaintenanceLog->id]);
    }

    public function test_validation_errors_on_create(): void
    {
        $response = $this->postJson('/api/capital_item_maintenance_logs', []);
        $response->assertStatus(422)
                 ->assertJsonValidationErrors(['name']);
    }
}
