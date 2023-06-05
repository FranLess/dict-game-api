<?php

namespace Tests\Feature;

use App\Models\Heart;
use App\Models\User;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class HeartTest extends TestCase
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
        $heart = Heart::factory(10)->create();
        $response = $this->get('/api/hearts');
        $response->assertStatus(200);
    }

    public function test_store()
    {

        $response = $this->post('/api/hearts', [
            'post_id' => 1,
            'user_id' => 1,
        ]);

        $response->assertStatus(201);
    }

    function test_show()
    {
        $heart = Heart::factory()->create();

        $response = $this->get('/api/hearts/' . $heart->id);
        $response->assertStatus(200);
    }

    function test_update()
    {
        $dummy = Heart::factory()->make();
        $heart = Heart::factory()->create();
        $response = $this->put('/api/hearts/' . $heart->id, [
            'user_id' => 1,
            'post_id' => 1,
        ]);
        $response->assertStatus(403);
    }

    public function test_destroy()
    {
        $heart = Heart::factory()->create();
        $response = $this->delete('/api/hearts/' . $heart->id);
        $response->assertStatus(204);
        $this->expectException(ModelNotFoundException::class);
        Heart::findOrFail($heart->id);
    }
}
