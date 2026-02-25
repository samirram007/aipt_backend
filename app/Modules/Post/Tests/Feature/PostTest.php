<?php

namespace App\Modules\Post\Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;
use App\Modules\Post\Models\Post;

class PostTest extends TestCase
{
    use RefreshDatabase;

    public function test_can_list_posts(): void
    {
        $response = $this->getJson('/api/posts');
        $response->assertStatus(200)
                 ->assertJsonStructure([
                     'data',
                     'status',
                     'code',
                     'message'
                 ]);
    }

    public function test_can_create_Post(): void
    {
        $data = ['name' => 'Test Post'];

        $response = $this->postJson('/api/posts', $data);
        $response->assertStatus(201)
                 ->assertJsonStructure([
                     'data',
                     'status',
                     'code',
                     'message'
                 ]);

        $this->assertDatabaseHas('posts', $data);
    }

    public function test_can_show_Post(): void
    {
        $Post = Post::factory()->create();

        $response = $this->getJson('/api/posts/' . $Post->id);
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

    public function test_can_update_Post(): void
    {
        $Post = Post::factory()->create();
        $data = ['name' => 'Updated Post'];

        $response = $this->putJson('/api/posts/' . $Post->id, $data);
        $response->assertStatus(200)
                 ->assertJsonStructure([
                     'data',
                     'status',
                     'code',
                     'message'
                 ]);

        $this->assertDatabaseHas('posts', $data);
    }

    public function test_can_delete_Post(): void
    {
        $Post = Post::factory()->create();

        $response = $this->deleteJson('/api/posts/' . $Post->id);
        $response->assertStatus(200)
                 ->assertJsonStructure([
                     'status',
                     'code',
                     'message'
                 ]);

        $this->assertDatabaseMissing('posts', ['id' => $Post->id]);
    }

    public function test_validation_errors_on_create(): void
    {
        $response = $this->postJson('/api/posts', []);
        $response->assertStatus(422)
                 ->assertJsonValidationErrors(['name']);
    }
}
