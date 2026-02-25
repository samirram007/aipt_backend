<?php

namespace App\Modules\CompanyType\Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;
use App\Modules\CompanyType\Models\CompanyType;

class CompanyTypeTest extends TestCase
{
    use RefreshDatabase;

    public function test_can_list_company_types(): void
    {
        $response = $this->getJson('/api/company_types');
        $response->assertStatus(200)
                 ->assertJsonStructure([
                     'data',
                     'status',
                     'code',
                     'message'
                 ]);
    }

    public function test_can_create_CompanyType(): void
    {
        $data = ['name' => 'Test CompanyType'];

        $response = $this->postJson('/api/company_types', $data);
        $response->assertStatus(201)
                 ->assertJsonStructure([
                     'data',
                     'status',
                     'code',
                     'message'
                 ]);

        $this->assertDatabaseHas('company_types', $data);
    }

    public function test_can_show_CompanyType(): void
    {
        $CompanyType = CompanyType::factory()->create();

        $response = $this->getJson('/api/company_types/' . $CompanyType->id);
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

    public function test_can_update_CompanyType(): void
    {
        $CompanyType = CompanyType::factory()->create();
        $data = ['name' => 'Updated CompanyType'];

        $response = $this->putJson('/api/company_types/' . $CompanyType->id, $data);
        $response->assertStatus(200)
                 ->assertJsonStructure([
                     'data',
                     'status',
                     'code',
                     'message'
                 ]);

        $this->assertDatabaseHas('company_types', $data);
    }

    public function test_can_delete_CompanyType(): void
    {
        $CompanyType = CompanyType::factory()->create();

        $response = $this->deleteJson('/api/company_types/' . $CompanyType->id);
        $response->assertStatus(200)
                 ->assertJsonStructure([
                     'status',
                     'code',
                     'message'
                 ]);

        $this->assertDatabaseMissing('company_types', ['id' => $CompanyType->id]);
    }

    public function test_validation_errors_on_create(): void
    {
        $response = $this->postJson('/api/company_types', []);
        $response->assertStatus(422)
                 ->assertJsonValidationErrors(['name']);
    }
}
