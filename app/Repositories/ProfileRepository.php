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

            $image = null;
            $imageHeader = null;

            if (data_get($data, 'image')) {
                $image = $data['image']->hashName();
                $this->uploads($image, auth()->user()->email . '/profile/');
            }
            if (data_get($data, 'image_header')) {
                $imageHeader = $data['image_header']->hashName();
                $this->uploads($imageHeader, auth()->user()->email . '/profile/');
            }

            $created = Profile::create([
                'day_of_birth' => data_get($data, 'day_of_birth'),
                'gender' => data_get($data, 'gender'),
                'country_id' => data_get($data, 'country_id'),
                'image' => $image,
                'image_header' => $imageHeader,
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

            $imageSource = $profile->image;
            $imageHeaderSource = $profile->image_header;

            if (data_get($data, 'image') && is_object($data['image'])) {
                $image = data_get($data, 'image');
                $imageSource = $data['image']->hashName();
                $imageUrl = asset('storage/' . auth()->user()->email . '/profile/' . $imageSource);
                $this->uploads($image, auth()->user()->email . '/profile/');
                $this->removeFile(auth()->user()->email . '/profile/' . $profile->image);
            }
            if (data_get($data, 'image_header') && is_object($data['image_header'])) {
                $imageHeader = data_get($data, 'image_header');
                $imageHeaderSource = $data['image_header']->hashName();
                $imageHeaderUrl = asset('storage/' . auth()->user()->email . '/profile/' . $imageHeaderSource);
                $this->uploads($imageHeader, auth()->user()->email . '/profile/');
                $this->removeFile(auth()->user()->email . '/profile/' . $profile->image_header);
            }

            $updated = $profile->update([
                'image' => $imageSource,
                'image_url' => $imageUrl ?? null,
                'image_header' => $imageHeaderSource,
                'image_header_url' => $imageHeaderUrl ?? null,
                'day_of_birth' => data_get($data, 'day_of_birth'),
                'gender' => data_get($data, 'gender'),
                'country_id' => data_get($data, 'country_id'),
                'title' => data_get($data, 'title'),
                'bio' => data_get($data, 'bio'),
                'likes' => data_get($data, 'likes'),
                'dislikes' => data_get($data, 'dislikes'),
                'address' => data_get($data, 'address'),
                'phone' => data_get($data, 'phone'),
                'public_email' => data_get($data, 'public_email'),
                'level_id' => data_get($data, 'level_id'),
                'sentimental_id' => data_get($data, 'sentimental_id'),
            ]);

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
