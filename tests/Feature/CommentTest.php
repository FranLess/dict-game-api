<?php

namespace Tests\Feature;

use App\Models\Comment;
use App\Models\User;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class CommentTest extends TestCase
{
    use RefreshDatabase;

    public function setUp(): void
    {
        parent::setUp();
        $this->actingAs(User::factory()->create());
        $this->artisan('db:seed');
    }

    public function test_index()
    {
        $comment = Comment::factory(10)->create();
        $response = $this->get('/api/comments');
        $response->assertStatus(200);
    }

    public function test_store()
    {

        $response = $this->post('/api/comments', [
            'content' => 'test',
            'post_id' => 1,
            'user_id' => 1,
            'comment_id' => null,
        ]);

        $response->assertStatus(201);
    }

    function test_show()
    {
        $comment = Comment::factory()->create();

        $response = $this->get('/api/comments/' . $comment->id);
        $response->assertStatus(200);
    }

    function test_update()
    {
        $dummy = Comment::factory()->make();
        $comment = Comment::factory()->create();
        $response = $this->put('/api/comments/' . $comment->id, [
            'content' => $dummy->content,
            'post_id' => $dummy->post_id,
            'user_id' => $dummy->user_id,
            'comment_id' => 1,
        ]);
        $response->assertStatus(204);
    }

    public function test_destroy()
    {
        $comment = Comment::factory()->create();
        $response = $this->delete('/api/comments/' . $comment->id);
        $response->assertStatus(204);
        $this->expectException(ModelNotFoundException::class);
        Comment::findOrFail($comment->id);
    }
}
