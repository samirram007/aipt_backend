<?php

namespace App\Modules\TestBooking\Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;
use App\Modules\TestBooking\Models\TestBooking;

class TestBookingTest extends TestCase
{
    use RefreshDatabase;

    public function test_can_list_test_bookings(): void
    {
        $response = $this->getJson('/api/test_bookings');
        $response->assertStatus(200)
                 ->assertJsonStructure([
                     'data',
                     'status',
                     'code',
                     'message'
                 ]);
    }

    public function test_can_create_TestBooking(): void
    {
        $data = ['name' => 'Test TestBooking'];

        $response = $this->postJson('/api/test_bookings', $data);
        $response->assertStatus(201)
                 ->assertJsonStructure([
                     'data',
                     'status',
                     'code',
                     'message'
                 ]);

        $this->assertDatabaseHas('test_bookings', $data);
    }

    public function test_can_show_TestBooking(): void
    {
        $TestBooking = TestBooking::factory()->create();

        $response = $this->getJson('/api/test_bookings/' . $TestBooking->id);
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

    public function test_can_update_TestBooking(): void
    {
        $TestBooking = TestBooking::factory()->create();
        $data = ['name' => 'Updated TestBooking'];

        $response = $this->putJson('/api/test_bookings/' . $TestBooking->id, $data);
        $response->assertStatus(200)
                 ->assertJsonStructure([
                     'data',
                     'status',
                     'code',
                     'message'
                 ]);

        $this->assertDatabaseHas('test_bookings', $data);
    }

    public function test_can_delete_TestBooking(): void
    {
        $TestBooking = TestBooking::factory()->create();

        $response = $this->deleteJson('/api/test_bookings/' . $TestBooking->id);
        $response->assertStatus(200)
                 ->assertJsonStructure([
                     'status',
                     'code',
                     'message'
                 ]);

        $this->assertDatabaseMissing('test_bookings', ['id' => $TestBooking->id]);
    }

    public function test_validation_errors_on_create(): void
    {
        $response = $this->postJson('/api/test_bookings', []);
        $response->assertStatus(422)
                 ->assertJsonValidationErrors(['name']);
    }
}
