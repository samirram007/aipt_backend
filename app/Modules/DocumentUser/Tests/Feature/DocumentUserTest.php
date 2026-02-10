<?php

namespace App\Modules\DocumentUser\Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;
use App\Modules\DocumentUser\Models\DocumentUser;

class DocumentUserTest extends TestCase
{
    use RefreshDatabase;

    public function test_can_list_document_users(): void
    {
        $response = $this->getJson('/api/document_users');
        $response->assertStatus(200)
                 ->assertJsonStructure([
                     'data',
                     'status',
                     'code',
                     'message'
                 ]);
    }

    public function test_can_create_DocumentUser(): void
    {
        $data = ['name' => 'Test DocumentUser'];

        $response = $this->postJson('/api/document_users', $data);
        $response->assertStatus(201)
                 ->assertJsonStructure([
                     'data',
                     'status',
                     'code',
                     'message'
                 ]);

        $this->assertDatabaseHas('document_users', $data);
    }

    public function test_can_show_DocumentUser(): void
    {
        $DocumentUser = DocumentUser::factory()->create();

        $response = $this->getJson('/api/document_users/' . $DocumentUser->id);
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

    public function test_can_update_DocumentUser(): void
    {
        $DocumentUser = DocumentUser::factory()->create();
        $data = ['name' => 'Updated DocumentUser'];

        $response = $this->putJson('/api/document_users/' . $DocumentUser->id, $data);
        $response->assertStatus(200)
                 ->assertJsonStructure([
                     'data',
                     'status',
                     'code',
                     'message'
                 ]);

        $this->assertDatabaseHas('document_users', $data);
    }

    public function test_can_delete_DocumentUser(): void
    {
        $DocumentUser = DocumentUser::factory()->create();

        $response = $this->deleteJson('/api/document_users/' . $DocumentUser->id);
        $response->assertStatus(200)
                 ->assertJsonStructure([
                     'status',
                     'code',
                     'message'
                 ]);

        $this->assertDatabaseMissing('document_users', ['id' => $DocumentUser->id]);
    }

    public function test_validation_errors_on_create(): void
    {
        $response = $this->postJson('/api/document_users', []);
        $response->assertStatus(422)
                 ->assertJsonValidationErrors(['name']);
    }
}
