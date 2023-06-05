<?php

namespace Tests\Feature;

use App\Models\Level;
use App\Models\User;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class LevelTest extends TestCase
{
    use RefreshDatabase;

    public function setUp(): void
    {
        parent::setUp();
        $this->actingAs(User::factory()->create([
            'is_admin' => true,
        ]));
        $this->artisan('db:seed');
    }

    public function test_index()
    {
        $level = Level::factory(10)->create();
        $response = $this->get('/api/levels');
        $response->assertStatus(200);
    }

    public function test_store()
    {

        $response = $this->post('/api/levels', [
            'name' => 'test',
        ]);

        $response->assertStatus(201);
    }

    function test_show()
    {
        $level = Level::factory()->create();

        $response = $this->get('/api/levels/' . $level->id);
        $response->assertStatus(200);
    }

    function test_update()
    {
        $dummy = Level::factory()->make();
        $level = Level::factory()->create();
        $response = $this->put('/api/levels/' . $level->id, [
            'name' => $dummy->name,
        ]);
        $response->assertStatus(204);
    }

    public function test_destroy()
    {
        $level = Level::factory()->create();
        $response = $this->delete('/api/levels/' . $level->id);
        $response->assertStatus(204);
        $this->expectException(ModelNotFoundException::class);
        Level::findOrFail($level->id);
    }
}
