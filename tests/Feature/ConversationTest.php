<?php

namespace Tests\Feature;

use App\Models\Conversation;
use App\Models\User;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class ConversationTest extends TestCase
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
        $conversation = Conversation::factory(10)->create();
        $response = $this->get('/api/conversations');
        $response->assertStatus(200);
    }

    public function test_store()
    {

        $response = $this->post('/api/conversations', [
            'sender_id' => 1,
            'receptor_id' => 2,
        ]);

        $response->assertStatus(201);
    }

    function test_show()
    {
        $conversation = Conversation::factory()->create();

        $response = $this->get('/api/conversations/' . $conversation->id);
        $response->assertStatus(200);
    }

    function test_update()
    {
        $dummy = Conversation::factory()->make();
        $conversation = Conversation::factory()->create();
        // $this->expectException();
        $response = $this->put('/api/conversations/' . $conversation->id, [
            'content' => $dummy->content,
            'post_id' => $dummy->post_id,
            'user_id' => $dummy->user_id,
            'conversation_id' => 1,
        ]);
        $response->assertStatus(403);
    }

    public function test_destroy()
    {
        $conversation = Conversation::factory()->create();
        $response = $this->delete('/api/conversations/' . $conversation->id);
        $response->assertStatus(204);
        $this->expectException(ModelNotFoundException::class);
        Conversation::findOrFail($conversation->id);
    }
}
