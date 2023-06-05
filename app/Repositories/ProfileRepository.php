<?php

namespace App\Repositories;

use App\Helpers\ImageManager;
use App\Models\Profile;
use Illuminate\Support\Facades\DB;

class ProfileRepository
{
    use ImageManager;
    public function store(array $data)
    {

        DB::transaction(function () use ($data) {
            $image = $data['image'];
            $imageHeader = $data['image_header'];
            $this->uploads($image, auth()->user()->email . '/profile/');
            $this->uploads($imageHeader, auth()->user()->email . '/profile/');

            $created = Profile::create([
                'day_of_birth' => data_get($data, 'day_of_birth'),
                'gender' => data_get($data, 'gender'),
                'country_id' => data_get($data, 'country_id'),
                'image' => $image->hashName(),
                'image_header' => $imageHeader->hashName(),
                'title' => data_get($data, 'title'),
                'bio' => data_get($data, 'bio'),
                'likes' => data_get($data, 'likes'),
                'dislikes' => data_get($data, 'dislikes'),
                'address' => data_get($data, 'address'),
                'phone' => data_get($data, 'phone'),
                'public_email' => data_get($data, 'public_email'),
                'user_id' => data_get($data, 'user_id'),
                'level_id' => data_get($data, 'level_id'),
                'sentimental_id' => data_get($data, 'sentimental_id'),
            ]);
            throw_if(!$created, \Exception::class,  'Error creating profile');

            return $created;
        });
    }

    public function update(array $data, Profile $profile)
    {
        DB::transaction(function () use ($data, $profile) {
            $image = $data['image'];
            $imageHeader = $data['image_header'];

            $this->removeFile(auth()->user()->email . '/profile/' . $profile->image);
            $this->removeFile(auth()->user()->email . '/profile/' . $profile->image_header);
            $updated = $profile->update([
                'image' => $image->hashName(),
                'image_header' => $imageHeader->hashName(),
                ...$data
            ]);

            $this->uploads($image, auth()->user()->email . '/profile/');
            $this->uploads($imageHeader, auth()->user()->email . '/profile/');
            throw_if(!$updated, \Exception::class,  'Error updating profile');
        });
        return $profile->refresh();
    }

    public function destroy(Profile $profile)
    {
        DB::transaction(function () use ($profile) {
            $this->removeFile(auth()->user()->email . '/profile/' . $profile->image);
            $this->removeFile(auth()->user()->email . '/profile/' . $profile->image_header);
            $deleted = $profile->delete();
            throw_if(!$deleted, \Exception::class,  'Error deleting profile');
        });
    }
}
