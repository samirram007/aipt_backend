<?php

namespace App\Modules\Language\Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;
use App\Modules\Language\Models\Language;

class LanguageTest extends TestCase
{
    use RefreshDatabase;

    public function test_can_list_languages(): void
    {
        $response = $this->getJson('/api/languages');
        $response->assertStatus(200)
                 ->assertJsonStructure([
                     'data',
                     'status',
                     'code',
                     'message'
                 ]);
    }

    public function test_can_create_Language(): void
    {
        $data = ['name' => 'Test Language'];

        $response = $this->postJson('/api/languages', $data);
        $response->assertStatus(201)
                 ->assertJsonStructure([
                     'data',
                     'status',
                     'code',
                     'message'
                 ]);

        $this->assertDatabaseHas('languages', $data);
    }

    public function test_can_show_Language(): void
    {
        $Language = Language::factory()->create();

        $response = $this->getJson('/api/languages/' . $Language->id);
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

    public function test_can_update_Language(): void
    {
        $Language = Language::factory()->create();
        $data = ['name' => 'Updated Language'];

        $response = $this->putJson('/api/languages/' . $Language->id, $data);
        $response->assertStatus(200)
                 ->assertJsonStructure([
                     'data',
                     'status',
                     'code',
                     'message'
                 ]);

        $this->assertDatabaseHas('languages', $data);
    }

    public function test_can_delete_Language(): void
    {
        $Language = Language::factory()->create();

        $response = $this->deleteJson('/api/languages/' . $Language->id);
        $response->assertStatus(200)
                 ->assertJsonStructure([
                     'status',
                     'code',
                     'message'
                 ]);

        $this->assertDatabaseMissing('languages', ['id' => $Language->id]);
    }

    public function test_validation_errors_on_create(): void
    {
        $response = $this->postJson('/api/languages', []);
        $response->assertStatus(422)
                 ->assertJsonValidationErrors(['name']);
    }
}
