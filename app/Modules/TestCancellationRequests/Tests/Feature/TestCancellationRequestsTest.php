<?php

namespace App\Modules\TestCancellationRequests\Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;
use App\Modules\TestCancellationRequests\Models\TestCancellationRequests;

class TestCancellationRequestsTest extends TestCase
{
    use RefreshDatabase;

    public function test_can_list_test_cancellation_requests(): void
    {
        $response = $this->getJson('/api/test_cancellation_requests');
        $response->assertStatus(200)
                 ->assertJsonStructure([
                     'data',
                     'status',
                     'code',
                     'message'
                 ]);
    }

    public function test_can_create_TestCancellationRequests(): void
    {
        $data = ['name' => 'Test TestCancellationRequests'];

        $response = $this->postJson('/api/test_cancellation_requests', $data);
        $response->assertStatus(201)
                 ->assertJsonStructure([
                     'data',
                     'status',
                     'code',
                     'message'
                 ]);

        $this->assertDatabaseHas('test_cancellation_requests', $data);
    }

    public function test_can_show_TestCancellationRequests(): void
    {
        $TestCancellationRequests = TestCancellationRequests::factory()->create();

        $response = $this->getJson('/api/test_cancellation_requests/' . $TestCancellationRequests->id);
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

    public function test_can_update_TestCancellationRequests(): void
    {
        $TestCancellationRequests = TestCancellationRequests::factory()->create();
        $data = ['name' => 'Updated TestCancellationRequests'];

        $response = $this->putJson('/api/test_cancellation_requests/' . $TestCancellationRequests->id, $data);
        $response->assertStatus(200)
                 ->assertJsonStructure([
                     'data',
                     'status',
                     'code',
                     'message'
                 ]);

        $this->assertDatabaseHas('test_cancellation_requests', $data);
    }

    public function test_can_delete_TestCancellationRequests(): void
    {
        $TestCancellationRequests = TestCancellationRequests::factory()->create();

        $response = $this->deleteJson('/api/test_cancellation_requests/' . $TestCancellationRequests->id);
        $response->assertStatus(200)
                 ->assertJsonStructure([
                     'status',
                     'code',
                     'message'
                 ]);

        $this->assertDatabaseMissing('test_cancellation_requests', ['id' => $TestCancellationRequests->id]);
    }

    public function test_validation_errors_on_create(): void
    {
        $response = $this->postJson('/api/test_cancellation_requests', []);
        $response->assertStatus(422)
                 ->assertJsonValidationErrors(['name']);
    }
}
