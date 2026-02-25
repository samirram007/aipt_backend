<?php

namespace App\Modules\FiscalYear\Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;
use App\Modules\FiscalYear\Models\FiscalYear;

class FiscalYearTest extends TestCase
{
    use RefreshDatabase;

    public function test_can_list_fiscal_years(): void
    {
        $response = $this->getJson('/api/fiscal_years');
        $response->assertStatus(200)
                 ->assertJsonStructure([
                     'data',
                     'status',
                     'code',
                     'message'
                 ]);
    }

    public function test_can_create_FiscalYear(): void
    {
        $data = ['name' => 'Test FiscalYear'];

        $response = $this->postJson('/api/fiscal_years', $data);
        $response->assertStatus(201)
                 ->assertJsonStructure([
                     'data',
                     'status',
                     'code',
                     'message'
                 ]);

        $this->assertDatabaseHas('fiscal_years', $data);
    }

    public function test_can_show_FiscalYear(): void
    {
        $FiscalYear = FiscalYear::factory()->create();

        $response = $this->getJson('/api/fiscal_years/' . $FiscalYear->id);
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

    public function test_can_update_FiscalYear(): void
    {
        $FiscalYear = FiscalYear::factory()->create();
        $data = ['name' => 'Updated FiscalYear'];

        $response = $this->putJson('/api/fiscal_years/' . $FiscalYear->id, $data);
        $response->assertStatus(200)
                 ->assertJsonStructure([
                     'data',
                     'status',
                     'code',
                     'message'
                 ]);

        $this->assertDatabaseHas('fiscal_years', $data);
    }

    public function test_can_delete_FiscalYear(): void
    {
        $FiscalYear = FiscalYear::factory()->create();

        $response = $this->deleteJson('/api/fiscal_years/' . $FiscalYear->id);
        $response->assertStatus(200)
                 ->assertJsonStructure([
                     'status',
                     'code',
                     'message'
                 ]);

        $this->assertDatabaseMissing('fiscal_years', ['id' => $FiscalYear->id]);
    }

    public function test_validation_errors_on_create(): void
    {
        $response = $this->postJson('/api/fiscal_years', []);
        $response->assertStatus(422)
                 ->assertJsonValidationErrors(['name']);
    }
}
