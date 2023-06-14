<?php

namespace Tests\Feature;

use App\Models\Post;
use App\Models\User;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use PhpParser\Node\Expr\AssignOp\Mod;
use Tests\TestCase;

class PostTest extends TestCase
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
        $post = Post::factory(10)->create();
        $response = $this->get('/api/posts');
        $response->assertStatus(200);
    }

    public function test_store()
    {
        Storage::fake('public');

        $image = UploadedFile::fake()->image('test.jpg');

        $response = $this->post('/api/posts', [
            'title' => 'test',
            'content' => 'test asdf asd',
            'user_id' => 1,
            'level_id' => 1,
            'receptor_type_id' => 1,
            'team_id' => 1,
            'image' => $image
        ]);

        Storage::disk('public')->assertExists(auth()->user()->email . '/posts/' . $image->hashName());
        $response->assertStatus(201);
    }

    public function test_store_without_image()
    {


        $response = $this->post('/api/posts', [
            'title' => 'test',
            'content' => 'test asdf asd',
            'user_id' => 1,
            'level_id' => 1,
            'receptor_type_id' => 1,
            'team_id' => 1,
        ]);

        $response->assertStatus(201);
    }

    function test_show()
    {
        $post = Post::factory()->create();

        $response = $this->get('/api/posts/' . $post->id);
        $response->assertStatus(200);
    }

    function test_update()
    {
        $dummy = Post::factory()->make();
        $post = Post::factory()->create();
        $response = $this->put('/api/posts/' . $post->id, [
            'title' => 'test',
            'body' => 'test',
            'user_id' => 1,
            'level_id' => 1,
            'receptor_type_id' => 1,
            'team_id' => 1
        ]);
        $response->assertStatus(200);
    }

    public function test_destroy()
    {
        $post = Post::factory()->create();
        $response = $this->delete('/api/posts/' . $post->id);
        $response->assertStatus(204);
        $this->expectException(ModelNotFoundException::class);
        Post::findOrFail($post->id);
    }
}
