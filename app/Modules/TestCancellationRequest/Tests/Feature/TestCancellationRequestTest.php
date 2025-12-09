<?php

namespace App\Modules\TestCancellationRequest\Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;
use App\Modules\TestCancellationRequest\Models\TestCancellationRequest;

class TestCancellationRequestTest extends TestCase
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

    public function test_can_create_TestCancellationRequest(): void
    {
        $data = ['name' => 'Test TestCancellationRequest'];

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

    public function test_can_show_TestCancellationRequest(): void
    {
        $TestCancellationRequest = TestCancellationRequest::factory()->create();

        $response = $this->getJson('/api/test_cancellation_requests/' . $TestCancellationRequest->id);
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

    public function test_can_update_TestCancellationRequest(): void
    {
        $TestCancellationRequest = TestCancellationRequest::factory()->create();
        $data = ['name' => 'Updated TestCancellationRequest'];

        $response = $this->putJson('/api/test_cancellation_requests/' . $TestCancellationRequest->id, $data);
        $response->assertStatus(200)
                 ->assertJsonStructure([
                     'data',
                     'status',
                     'code',
                     'message'
                 ]);

        $this->assertDatabaseHas('test_cancellation_requests', $data);
    }

    public function test_can_delete_TestCancellationRequest(): void
    {
        $TestCancellationRequest = TestCancellationRequest::factory()->create();

        $response = $this->deleteJson('/api/test_cancellation_requests/' . $TestCancellationRequest->id);
        $response->assertStatus(200)
                 ->assertJsonStructure([
                     'status',
                     'code',
                     'message'
                 ]);

        $this->assertDatabaseMissing('test_cancellation_requests', ['id' => $TestCancellationRequest->id]);
    }

    public function test_validation_errors_on_create(): void
    {
        $response = $this->postJson('/api/test_cancellation_requests', []);
        $response->assertStatus(422)
                 ->assertJsonValidationErrors(['name']);
    }
}
