<?php

namespace App\Modules\TestItemReportTemplate\Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;
use App\Modules\TestItemReportTemplate\Models\TestItemReportTemplate;

class TestItemReportTemplateTest extends TestCase
{
    use RefreshDatabase;

    public function test_can_list_test_item_report_templates(): void
    {
        $response = $this->getJson('/api/test_item_report_templates');
        $response->assertStatus(200)
                 ->assertJsonStructure([
                     'data',
                     'status',
                     'code',
                     'message'
                 ]);
    }

    public function test_can_create_TestItemReportTemplate(): void
    {
        $data = ['name' => 'Test TestItemReportTemplate'];

        $response = $this->postJson('/api/test_item_report_templates', $data);
        $response->assertStatus(201)
                 ->assertJsonStructure([
                     'data',
                     'status',
                     'code',
                     'message'
                 ]);

        $this->assertDatabaseHas('test_item_report_templates', $data);
    }

    public function test_can_show_TestItemReportTemplate(): void
    {
        $TestItemReportTemplate = TestItemReportTemplate::factory()->create();

        $response = $this->getJson('/api/test_item_report_templates/' . $TestItemReportTemplate->id);
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

    public function test_can_update_TestItemReportTemplate(): void
    {
        $TestItemReportTemplate = TestItemReportTemplate::factory()->create();
        $data = ['name' => 'Updated TestItemReportTemplate'];

        $response = $this->putJson('/api/test_item_report_templates/' . $TestItemReportTemplate->id, $data);
        $response->assertStatus(200)
                 ->assertJsonStructure([
                     'data',
                     'status',
                     'code',
                     'message'
                 ]);

        $this->assertDatabaseHas('test_item_report_templates', $data);
    }

    public function test_can_delete_TestItemReportTemplate(): void
    {
        $TestItemReportTemplate = TestItemReportTemplate::factory()->create();

        $response = $this->deleteJson('/api/test_item_report_templates/' . $TestItemReportTemplate->id);
        $response->assertStatus(200)
                 ->assertJsonStructure([
                     'status',
                     'code',
                     'message'
                 ]);

        $this->assertDatabaseMissing('test_item_report_templates', ['id' => $TestItemReportTemplate->id]);
    }

    public function test_validation_errors_on_create(): void
    {
        $response = $this->postJson('/api/test_item_report_templates', []);
        $response->assertStatus(422)
                 ->assertJsonValidationErrors(['name']);
    }
}
