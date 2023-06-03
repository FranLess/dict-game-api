<?php

namespace Tests\Feature;

use App\Models\Sentimental;
use App\Models\User;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class SentimentalTest extends TestCase
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
        $sentimental = Sentimental::factory(10)->create();
        $response = $this->get('/api/sentimentals');
        $response->assertStatus(200);
    }

    public function test_store()
    {

        $response = $this->post('/api/sentimentals', [
            'name' => 'test',
        ]);

        $response->assertStatus(201);
    }

    function test_show()
    {
        $sentimental = Sentimental::factory()->create();

        $response = $this->get('/api/sentimentals/' . $sentimental->id);
        $response->assertStatus(200);
    }

    function test_update()
    {
        $dummy = Sentimental::factory()->make();
        $sentimental = Sentimental::factory()->create();
        $response = $this->put('/api/sentimentals/' . $sentimental->id, [
            'name' => $dummy->name,
        ]);
        $response->assertStatus(204);
    }

    public function test_destroy()
    {
        $sentimental = Sentimental::factory()->create();
        $response = $this->delete('/api/sentimentals/' . $sentimental->id);
        $response->assertStatus(204);
        $this->expectException(ModelNotFoundException::class);
        Sentimental::findOrFail($sentimental->id);
    }
}
