<?php

namespace App\Modules\JobOrderHistory\Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;
use App\Modules\JobOrderHistory\Models\JobOrderHistory;

class JobOrderHistoryTest extends TestCase
{
    use RefreshDatabase;

    public function test_can_list_job_order_histories(): void
    {
        $response = $this->getJson('/api/job_order_histories');
        $response->assertStatus(200)
                 ->assertJsonStructure([
                     'data',
                     'status',
                     'code',
                     'message'
                 ]);
    }

    public function test_can_create_JobOrderHistory(): void
    {
        $data = ['name' => 'Test JobOrderHistory'];

        $response = $this->postJson('/api/job_order_histories', $data);
        $response->assertStatus(201)
                 ->assertJsonStructure([
                     'data',
                     'status',
                     'code',
                     'message'
                 ]);

        $this->assertDatabaseHas('job_order_histories', $data);
    }

    public function test_can_show_JobOrderHistory(): void
    {
        $JobOrderHistory = JobOrderHistory::factory()->create();

        $response = $this->getJson('/api/job_order_histories/' . $JobOrderHistory->id);
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

    public function test_can_update_JobOrderHistory(): void
    {
        $JobOrderHistory = JobOrderHistory::factory()->create();
        $data = ['name' => 'Updated JobOrderHistory'];

        $response = $this->putJson('/api/job_order_histories/' . $JobOrderHistory->id, $data);
        $response->assertStatus(200)
                 ->assertJsonStructure([
                     'data',
                     'status',
                     'code',
                     'message'
                 ]);

        $this->assertDatabaseHas('job_order_histories', $data);
    }

    public function test_can_delete_JobOrderHistory(): void
    {
        $JobOrderHistory = JobOrderHistory::factory()->create();

        $response = $this->deleteJson('/api/job_order_histories/' . $JobOrderHistory->id);
        $response->assertStatus(200)
                 ->assertJsonStructure([
                     'status',
                     'code',
                     'message'
                 ]);

        $this->assertDatabaseMissing('job_order_histories', ['id' => $JobOrderHistory->id]);
    }

    public function test_validation_errors_on_create(): void
    {
        $response = $this->postJson('/api/job_order_histories', []);
        $response->assertStatus(422)
                 ->assertJsonValidationErrors(['name']);
    }
}
