<?php

namespace App\Modules\Salary\Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;
use App\Modules\Salary\Models\Salary;

class SalaryTest extends TestCase
{
    use RefreshDatabase;

    public function test_can_list_salaries(): void
    {
        $response = $this->getJson('/api/salaries');
        $response->assertStatus(200)
                 ->assertJsonStructure([
                     'data',
                     'status',
                     'code',
                     'message'
                 ]);
    }

    public function test_can_create_Salary(): void
    {
        $data = ['name' => 'Test Salary'];

        $response = $this->postJson('/api/salaries', $data);
        $response->assertStatus(201)
                 ->assertJsonStructure([
                     'data',
                     'status',
                     'code',
                     'message'
                 ]);

        $this->assertDatabaseHas('salaries', $data);
    }

    public function test_can_show_Salary(): void
    {
        $Salary = Salary::factory()->create();

        $response = $this->getJson('/api/salaries/' . $Salary->id);
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

    public function test_can_update_Salary(): void
    {
        $Salary = Salary::factory()->create();
        $data = ['name' => 'Updated Salary'];

        $response = $this->putJson('/api/salaries/' . $Salary->id, $data);
        $response->assertStatus(200)
                 ->assertJsonStructure([
                     'data',
                     'status',
                     'code',
                     'message'
                 ]);

        $this->assertDatabaseHas('salaries', $data);
    }

    public function test_can_delete_Salary(): void
    {
        $Salary = Salary::factory()->create();

        $response = $this->deleteJson('/api/salaries/' . $Salary->id);
        $response->assertStatus(200)
                 ->assertJsonStructure([
                     'status',
                     'code',
                     'message'
                 ]);

        $this->assertDatabaseMissing('salaries', ['id' => $Salary->id]);
    }

    public function test_validation_errors_on_create(): void
    {
        $response = $this->postJson('/api/salaries', []);
        $response->assertStatus(422)
                 ->assertJsonValidationErrors(['name']);
    }
}
