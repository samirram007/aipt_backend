<?php

namespace App\Modules\JobOrder\Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;
use App\Modules\JobOrder\Models\JobOrder;

class JobOrderTest extends TestCase
{
    use RefreshDatabase;

    public function test_can_list_job_orders(): void
    {
        $response = $this->getJson('/api/job_orders');
        $response->assertStatus(200)
                 ->assertJsonStructure([
                     'data',
                     'status',
                     'code',
                     'message'
                 ]);
    }

    public function test_can_create_JobOrder(): void
    {
        $data = ['name' => 'Test JobOrder'];

        $response = $this->postJson('/api/job_orders', $data);
        $response->assertStatus(201)
                 ->assertJsonStructure([
                     'data',
                     'status',
                     'code',
                     'message'
                 ]);

        $this->assertDatabaseHas('job_orders', $data);
    }

    public function test_can_show_JobOrder(): void
    {
        $JobOrder = JobOrder::factory()->create();

        $response = $this->getJson('/api/job_orders/' . $JobOrder->id);
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

    public function test_can_update_JobOrder(): void
    {
        $JobOrder = JobOrder::factory()->create();
        $data = ['name' => 'Updated JobOrder'];

        $response = $this->putJson('/api/job_orders/' . $JobOrder->id, $data);
        $response->assertStatus(200)
                 ->assertJsonStructure([
                     'data',
                     'status',
                     'code',
                     'message'
                 ]);

        $this->assertDatabaseHas('job_orders', $data);
    }

    public function test_can_delete_JobOrder(): void
    {
        $JobOrder = JobOrder::factory()->create();

        $response = $this->deleteJson('/api/job_orders/' . $JobOrder->id);
        $response->assertStatus(200)
                 ->assertJsonStructure([
                     'status',
                     'code',
                     'message'
                 ]);

        $this->assertDatabaseMissing('job_orders', ['id' => $JobOrder->id]);
    }

    public function test_validation_errors_on_create(): void
    {
        $response = $this->postJson('/api/job_orders', []);
        $response->assertStatus(422)
                 ->assertJsonValidationErrors(['name']);
    }
}
