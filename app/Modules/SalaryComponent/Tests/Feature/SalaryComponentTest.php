<?php

namespace App\Modules\SalaryComponent\Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;
use App\Modules\SalaryComponent\Models\SalaryComponent;

class SalaryComponentTest extends TestCase
{
    use RefreshDatabase;

    public function test_can_list_salary_components(): void
    {
        $response = $this->getJson('/api/salary_components');
        $response->assertStatus(200)
                 ->assertJsonStructure([
                     'data',
                     'status',
                     'code',
                     'message'
                 ]);
    }

    public function test_can_create_SalaryComponent(): void
    {
        $data = ['name' => 'Test SalaryComponent'];

        $response = $this->postJson('/api/salary_components', $data);
        $response->assertStatus(201)
                 ->assertJsonStructure([
                     'data',
                     'status',
                     'code',
                     'message'
                 ]);

        $this->assertDatabaseHas('salary_components', $data);
    }

    public function test_can_show_SalaryComponent(): void
    {
        $SalaryComponent = SalaryComponent::factory()->create();

        $response = $this->getJson('/api/salary_components/' . $SalaryComponent->id);
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

    public function test_can_update_SalaryComponent(): void
    {
        $SalaryComponent = SalaryComponent::factory()->create();
        $data = ['name' => 'Updated SalaryComponent'];

        $response = $this->putJson('/api/salary_components/' . $SalaryComponent->id, $data);
        $response->assertStatus(200)
                 ->assertJsonStructure([
                     'data',
                     'status',
                     'code',
                     'message'
                 ]);

        $this->assertDatabaseHas('salary_components', $data);
    }

    public function test_can_delete_SalaryComponent(): void
    {
        $SalaryComponent = SalaryComponent::factory()->create();

        $response = $this->deleteJson('/api/salary_components/' . $SalaryComponent->id);
        $response->assertStatus(200)
                 ->assertJsonStructure([
                     'status',
                     'code',
                     'message'
                 ]);

        $this->assertDatabaseMissing('salary_components', ['id' => $SalaryComponent->id]);
    }

    public function test_validation_errors_on_create(): void
    {
        $response = $this->postJson('/api/salary_components', []);
        $response->assertStatus(422)
                 ->assertJsonValidationErrors(['name']);
    }
}
