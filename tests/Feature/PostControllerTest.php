<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Models\Forums\PostModel;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Contracts\Auth\Authenticatable;

class PostControllerTest extends TestCase
{
    use RefreshDatabase;

    public function test_create_post()
    {
        $user = User::factory()->create();
        $this->actingAs($user);

        $response = $this->postJson('/forums/newPost', [
            'title' => 'Test Post',
            'content' => 'This is a test post.',
            'category_id' => 1,
        ]);

        $response->assertStatus(302); // Redirect after creation
        $this->assertDatabaseHas('posts', [
            'title' => 'Test Post',
            'user_id' => $user->id,
        ]);
    }

    public function test_update_post()
    {
        $user = User::factory()->create();
        $post = PostModel::factory()->create(['user_id' => $user->id]);
        $this->actingAs($user);

        $response = $this->putJson("/forums/posts/{$post->id}", [
            'title' => 'Updated Title',
            'content' => 'Updated content.',
        ]);

        $response->assertStatus(302); // Redirect after update
        $this->assertDatabaseHas('posts', [
            'id' => $post->id,
            'title' => 'Updated Title',
        ]);
    }

    public function test_delete_post()
    {
        $user = User::factory()->create();
        $post = PostModel::factory()->create(['user_id' => $user->id]);
        $this->actingAs($user);

        $response = $this->deleteJson("/forums/posts/{$post->id}");

        $response->assertStatus(302); // Redirect after deletion
        $this->assertDatabaseMissing('posts', [
            'id' => $post->id,
        ]);
    }
}
