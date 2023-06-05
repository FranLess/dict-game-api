<?php

namespace Tests\Feature;

use App\Models\Message;
use App\Models\User;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class MessageTest extends TestCase
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
        $message = Message::factory(10)->create();
        $response = $this->get('/api/messages');
        $response->assertStatus(200);
    }

    public function test_store()
    {
        $dummy = Message::factory()->make();
        $response = $this->post('/api/messages', [
            'user_id' => $dummy->user_id,
            'conversation_id' => $dummy->conversation_id,
            'content' => 'test',
            'is_read' => false
        ]);

        $response->assertStatus(201);
    }

    function test_show()
    {
        $message = Message::factory()->create();

        $response = $this->get('/api/messages/' . $message->id);
        $response->assertStatus(200);
    }

    function test_update()
    {
        $dummy = Message::factory()->make();
        $message = Message::factory()->create();
        $response = $this->put('/api/messages/' . $message->id, [
            'user_id' => $dummy->user_id,
            'conversation_id' => $dummy->conversation_id,
            'content' => 'test',
            'is_read' => true
        ]);
        $response->assertStatus(204);
    }

    public function test_destroy()
    {
        $message = Message::factory()->create();
        $response = $this->delete('/api/messages/' . $message->id);
        $response->assertStatus(204);
        $this->expectException(ModelNotFoundException::class);
        Message::findOrFail($message->id);
    }
}
