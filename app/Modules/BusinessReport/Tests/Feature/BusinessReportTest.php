<?php

namespace App\Modules\BusinessReport\Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;
use App\Modules\BusinessReport\Models\BusinessReport;

class BusinessReportTest extends TestCase
{
    use RefreshDatabase;

    public function test_can_list_business_reports(): void
    {
        $response = $this->getJson('/api/business_reports');
        $response->assertStatus(200)
                 ->assertJsonStructure([
                     'data',
                     'status',
                     'code',
                     'message'
                 ]);
    }

    public function test_can_create_BusinessReport(): void
    {
        $data = ['name' => 'Test BusinessReport'];

        $response = $this->postJson('/api/business_reports', $data);
        $response->assertStatus(201)
                 ->assertJsonStructure([
                     'data',
                     'status',
                     'code',
                     'message'
                 ]);

        $this->assertDatabaseHas('business_reports', $data);
    }

    public function test_can_show_BusinessReport(): void
    {
        $BusinessReport = BusinessReport::factory()->create();

        $response = $this->getJson('/api/business_reports/' . $BusinessReport->id);
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

    public function test_can_update_BusinessReport(): void
    {
        $BusinessReport = BusinessReport::factory()->create();
        $data = ['name' => 'Updated BusinessReport'];

        $response = $this->putJson('/api/business_reports/' . $BusinessReport->id, $data);
        $response->assertStatus(200)
                 ->assertJsonStructure([
                     'data',
                     'status',
                     'code',
                     'message'
                 ]);

        $this->assertDatabaseHas('business_reports', $data);
    }

    public function test_can_delete_BusinessReport(): void
    {
        $BusinessReport = BusinessReport::factory()->create();

        $response = $this->deleteJson('/api/business_reports/' . $BusinessReport->id);
        $response->assertStatus(200)
                 ->assertJsonStructure([
                     'status',
                     'code',
                     'message'
                 ]);

        $this->assertDatabaseMissing('business_reports', ['id' => $BusinessReport->id]);
    }

    public function test_validation_errors_on_create(): void
    {
        $response = $this->postJson('/api/business_reports', []);
        $response->assertStatus(422)
                 ->assertJsonValidationErrors(['name']);
    }
}
