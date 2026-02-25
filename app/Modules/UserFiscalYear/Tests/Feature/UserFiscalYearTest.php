<?php

namespace App\Modules\UserFiscalYear\Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;
use App\Modules\UserFiscalYear\Models\UserFiscalYear;

class UserFiscalYearTest extends TestCase
{
    use RefreshDatabase;

    public function test_can_list_user_fiscal_years(): void
    {
        $response = $this->getJson('/api/user_fiscal_years');
        $response->assertStatus(200)
                 ->assertJsonStructure([
                     'data',
                     'status',
                     'code',
                     'message'
                 ]);
    }

    public function test_can_create_UserFiscalYear(): void
    {
        $data = ['name' => 'Test UserFiscalYear'];

        $response = $this->postJson('/api/user_fiscal_years', $data);
        $response->assertStatus(201)
                 ->assertJsonStructure([
                     'data',
                     'status',
                     'code',
                     'message'
                 ]);

        $this->assertDatabaseHas('user_fiscal_years', $data);
    }

    public function test_can_show_UserFiscalYear(): void
    {
        $UserFiscalYear = UserFiscalYear::factory()->create();

        $response = $this->getJson('/api/user_fiscal_years/' . $UserFiscalYear->id);
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

    public function test_can_update_UserFiscalYear(): void
    {
        $UserFiscalYear = UserFiscalYear::factory()->create();
        $data = ['name' => 'Updated UserFiscalYear'];

        $response = $this->putJson('/api/user_fiscal_years/' . $UserFiscalYear->id, $data);
        $response->assertStatus(200)
                 ->assertJsonStructure([
                     'data',
                     'status',
                     'code',
                     'message'
                 ]);

        $this->assertDatabaseHas('user_fiscal_years', $data);
    }

    public function test_can_delete_UserFiscalYear(): void
    {
        $UserFiscalYear = UserFiscalYear::factory()->create();

        $response = $this->deleteJson('/api/user_fiscal_years/' . $UserFiscalYear->id);
        $response->assertStatus(200)
                 ->assertJsonStructure([
                     'status',
                     'code',
                     'message'
                 ]);

        $this->assertDatabaseMissing('user_fiscal_years', ['id' => $UserFiscalYear->id]);
    }

    public function test_validation_errors_on_create(): void
    {
        $response = $this->postJson('/api/user_fiscal_years', []);
        $response->assertStatus(422)
                 ->assertJsonValidationErrors(['name']);
    }
}
