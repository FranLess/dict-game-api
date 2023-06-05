<?php

namespace Tests\Feature;

use App\Models\Image;
use App\Models\User;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Tests\TestCase;

class ImageTest extends TestCase
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
        $image = Image::factory(10)->create();
        $response = $this->get('/api/images');
        $response->assertStatus(200);
    }

    public function test_store()
    {
        Storage::fake('public');

        $file = UploadedFile::fake()->image('avatar.jpg');


        $response = $this->post('/api/images', [
            'source' => $file,
            'user_id' => 1,
        ]);

        Storage::disk('public')->assertExists(auth()->user()->email . '/images/' . $file->hashName());
        $response->assertStatus(201);
    }

    function test_show()
    {
        $image = Image::factory()->create();

        $response = $this->get('/api/images/' . $image->id);
        $response->assertStatus(200);
    }

    function test_update()
    {
        Storage::fake('public');
        $file = UploadedFile::fake()->image('avatar.jpg');

        $image = Image::factory()->create();
        $response = $this->put('/api/images/' . $image->id, [
            'source' => $file,
        ]);
        Storage::disk('public')->assertExists(auth()->user()->email . '/images/' . $file->hashName());
        $response->assertStatus(204);
    }

    public function test_destroy()
    {
        Storage::fake('public');

        $image = Image::factory()->create();
        $response = $this->delete('/api/images/' . $image->id);
        $response->assertStatus(204);
        Storage::disk('public')->assertMissing(auth()->user()->email . '/images/' . $image->source);

        $this->expectException(ModelNotFoundException::class);
        Image::findOrFail($image->id);
    }
}
