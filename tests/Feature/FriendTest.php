<?php

namespace Tests\Feature;

use App\Models\Friend;
use App\Models\User;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class FriendTest extends TestCase
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
        $friend = Friend::factory(10)->create();
        $response = $this->get('/api/friends');
        $response->assertStatus(200);
    }

    public function test_store()
    {

        $response = $this->post('/api/friends', [
            'sender_id' => 1,
            'receptor_id' => 2,
        ]);

        $response->assertStatus(201);
    }

    function test_show()
    {
        $friend = Friend::factory()->create();

        $response = $this->get('/api/friends/' . $friend->id);
        $response->assertStatus(200);
    }

    function test_update()
    {
        $dummy = Friend::factory()->make();
        $friend = Friend::factory()->create();
        $response = $this->put('/api/friends/' . $friend->id, [
            'is_read' => true,
            'is_accepted' => true,
        ]);
        $response->assertStatus(204);
    }

    public function test_destroy()
    {
        $friend = Friend::factory()->create();
        $response = $this->delete('/api/friends/' . $friend->id);
        $response->assertStatus(204);
        $this->expectException(ModelNotFoundException::class);
        Friend::findOrFail($friend->id);
    }
}
