<?php

namespace Tests\Feature;

use App\Models\ReceptorType;
use App\Models\User;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class ReceptorTypeTest extends TestCase
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
        $receptorType = ReceptorType::factory(10)->create();
        $response = $this->get('/api/receptor-types');
        $response->assertStatus(200);
    }

    public function test_store()
    {

        $response = $this->post('/api/receptor-types', [
            'name' => 'test',
        ]);

        $response->assertStatus(201);
    }

    function test_show()
    {
        $receptorType = ReceptorType::factory()->create();

        $response = $this->get('/api/receptor-types/' . $receptorType->id);
        $response->assertStatus(200);
    }

    function test_update()
    {
        $dummy = ReceptorType::factory()->make();
        $receptorType = ReceptorType::factory()->create();
        $response = $this->put('/api/receptor-types/' . $receptorType->id, [
            'name' => $dummy->name,
        ]);
        $response->assertStatus(204);
    }

    public function test_destroy()
    {
        $receptorType = ReceptorType::factory()->create();
        $response = $this->delete('/api/receptor-types/' . $receptorType->id);
        $response->assertStatus(204);
        $this->expectException(ModelNotFoundException::class);
        ReceptorType::findOrFail($receptorType->id);
    }
}
