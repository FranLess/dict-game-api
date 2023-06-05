<?php

namespace Tests\Feature;

use App\Models\Profile;
use App\Models\User;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Tests\TestCase;

class ProfileTest extends TestCase
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
        $image = Profile::factory(10)->create();
        $response = $this->get('/api/profiles');
        $response->assertStatus(200);
    }

    public function test_store()
    {
        Storage::fake('public');

        $image = UploadedFile::fake()->image('avatar.jpg');
        $imageHeader = UploadedFile::fake()->image('header.jpg');
        $dummy = Profile::factory()->make();

        $response = $this->post('/api/profiles', [
            'image' => $image,
            'image_header' => $imageHeader,
            'day_of_birth' => $dummy->day_of_birth,
            'gender' => $dummy->gender,
            'country_id' => $dummy->country_id,
            'title' => $dummy->title,
            'bio' => $dummy->bio,
            'likes' => $dummy->likes,
            'dislikes' => $dummy->dislikes,
            'address' => $dummy->address,
            'phone' => $dummy->phone,
            'public_email' => $dummy->public_email,
            'user_id' => $dummy->user_id,
            'level_id' => $dummy->level_id,
            'sentimental_id' => $dummy->sentimental_id,
        ]);

        Storage::disk('public')->assertExists(auth()->user()->email . '/profile/' . $image->hashName());
        Storage::disk('public')->assertExists(auth()->user()->email . '/profile/' . $imageHeader->hashName());
        $response->assertStatus(201);
    }

    function test_show()
    {
        $image = Profile::factory()->create();

        $response = $this->get('/api/profiles/' . $image->id);
        $response->assertStatus(200);
    }

    function test_update()
    {
        Storage::fake('public');
        $image = UploadedFile::fake()->image('avatar.jpg');
        $imageHeader = UploadedFile::fake()->image('header.jpg');

        $dummy = Profile::factory()->make();
        $profile = Profile::factory()->create();
        $response = $this->put('/api/profiles/' . $profile->id, [
            'image' => $image,
            'image_header' => $imageHeader,
            'day_of_birth' => $dummy->day_of_birth,
            'gender' => $dummy->gender,
            'country_id' => $dummy->country_id,
            'title' => $dummy->title,
            'bio' => $dummy->bio,
            'likes' => $dummy->likes,
            'dislikes' => $dummy->dislikes,
            'address' => $dummy->address,
            'phone' => $dummy->phone,
            'public_email' => $dummy->public_email,
            'user_id' => $dummy->user_id,
            'level_id' => $dummy->level_id,
            'sentimental_id' => $dummy->sentimental_id,
        ]);
        Storage::disk('public')->assertExists(auth()->user()->email . '/profile/' . $image->hashName());
        Storage::disk('public')->assertExists(auth()->user()->email . '/profile/' . $imageHeader->hashName());
        $response->assertStatus(204);
    }


    public function test_destroy()
    {
        Storage::fake('public');

        $profile = Profile::factory()->create();
        $response = $this->delete('/api/profiles/' . $profile->id);
        $response->assertStatus(204);
        Storage::disk('public')->assertMissing(auth()->user()->email . '/profile/' . $profile->source);

        $this->expectException(ModelNotFoundException::class);
        Profile::findOrFail($profile->id);
    }
}
