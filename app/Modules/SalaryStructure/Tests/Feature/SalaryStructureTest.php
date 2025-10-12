<?php

namespace App\Modules\SalaryStructure\Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;
use App\Modules\SalaryStructure\Models\SalaryStructure;

class SalaryStructureTest extends TestCase
{
    use RefreshDatabase;

    public function test_can_list_salary_structures(): void
    {
        $response = $this->getJson('/api/salary_structures');
        $response->assertStatus(200)
                 ->assertJsonStructure([
                     'data',
                     'status',
                     'code',
                     'message'
                 ]);
    }

    public function test_can_create_SalaryStructure(): void
    {
        $data = ['name' => 'Test SalaryStructure'];

        $response = $this->postJson('/api/salary_structures', $data);
        $response->assertStatus(201)
                 ->assertJsonStructure([
                     'data',
                     'status',
                     'code',
                     'message'
                 ]);

        $this->assertDatabaseHas('salary_structures', $data);
    }

    public function test_can_show_SalaryStructure(): void
    {
        $SalaryStructure = SalaryStructure::factory()->create();

        $response = $this->getJson('/api/salary_structures/' . $SalaryStructure->id);
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

    public function test_can_update_SalaryStructure(): void
    {
        $SalaryStructure = SalaryStructure::factory()->create();
        $data = ['name' => 'Updated SalaryStructure'];

        $response = $this->putJson('/api/salary_structures/' . $SalaryStructure->id, $data);
        $response->assertStatus(200)
                 ->assertJsonStructure([
                     'data',
                     'status',
                     'code',
                     'message'
                 ]);

        $this->assertDatabaseHas('salary_structures', $data);
    }

    public function test_can_delete_SalaryStructure(): void
    {
        $SalaryStructure = SalaryStructure::factory()->create();

        $response = $this->deleteJson('/api/salary_structures/' . $SalaryStructure->id);
        $response->assertStatus(200)
                 ->assertJsonStructure([
                     'status',
                     'code',
                     'message'
                 ]);

        $this->assertDatabaseMissing('salary_structures', ['id' => $SalaryStructure->id]);
    }

    public function test_validation_errors_on_create(): void
    {
        $response = $this->postJson('/api/salary_structures', []);
        $response->assertStatus(422)
                 ->assertJsonValidationErrors(['name']);
    }
}
