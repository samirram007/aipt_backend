<?php

namespace App\Modules\Customer\Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;
use App\Modules\Customer\Models\Customer;

class CustomerTest extends TestCase
{
    use RefreshDatabase;

    public function test_can_list_customers(): void
    {
        $response = $this->getJson('/api/customers');
        $response->assertStatus(200)
                 ->assertJsonStructure([
                     'data',
                     'status',
                     'code',
                     'message'
                 ]);
    }

    public function test_can_create_Customer(): void
    {
        $data = ['name' => 'Test Customer'];

        $response = $this->postJson('/api/customers', $data);
        $response->assertStatus(201)
                 ->assertJsonStructure([
                     'data',
                     'status',
                     'code',
                     'message'
                 ]);

        $this->assertDatabaseHas('customers', $data);
    }

    public function test_can_show_Customer(): void
    {
        $Customer = Customer::factory()->create();

        $response = $this->getJson('/api/customers/' . $Customer->id);
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

    public function test_can_update_Customer(): void
    {
        $Customer = Customer::factory()->create();
        $data = ['name' => 'Updated Customer'];

        $response = $this->putJson('/api/customers/' . $Customer->id, $data);
        $response->assertStatus(200)
                 ->assertJsonStructure([
                     'data',
                     'status',
                     'code',
                     'message'
                 ]);

        $this->assertDatabaseHas('customers', $data);
    }

    public function test_can_delete_Customer(): void
    {
        $Customer = Customer::factory()->create();

        $response = $this->deleteJson('/api/customers/' . $Customer->id);
        $response->assertStatus(200)
                 ->assertJsonStructure([
                     'status',
                     'code',
                     'message'
                 ]);

        $this->assertDatabaseMissing('customers', ['id' => $Customer->id]);
    }

    public function test_validation_errors_on_create(): void
    {
        $response = $this->postJson('/api/customers', []);
        $response->assertStatus(422)
                 ->assertJsonValidationErrors(['name']);
    }
}
