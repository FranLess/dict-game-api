<?php

namespace App\Repositories;

use App\Helpers\ImageManager;
use App\Models\Image;
use Illuminate\Support\Facades\DB;

class ImageRepository
{
    use ImageManager;
    public function store(array $data)
    {
        DB::transaction(function () use ($data) {

            // $path = public_path('images/');
            // !is_dir($path) &&
            //     mkdir($path, 0777, true);

            if ($file = $data['source']) {

                $this->uploads($file, auth()->user()->email . '/images/');

                $created = Image::create([
                    'source' => $file->hashName(),
                    'user_id' => data_get($data, 'user_id'),
                ]);
            }

            throw_if(!$created, \Exception::class,  'Error creating image');

            return $created;
        });
    }

    public function update(array $data, Image $image)
    {
        DB::transaction(function () use ($data, $image) {
            $file = $data['source'];
            $this->removeFile(auth()->user()->email . '/images/' . $image->source);
            $updated = $image->update([
                'source' => $file->hashName(),
            ]);
            $this->uploads($file, auth()->user()->email . '/images/');
            throw_if(!$updated, \Exception::class,  'Error updating image');
        });
        return $image->refresh();
    }

    public function destroy(Image $image)
    {
        DB::transaction(function () use ($image) {
            $deleted = $image->delete();
            $this->removeFile(auth()->user()->email . '/images/' . $image->source);
            throw_if(!$deleted, \Exception::class,  'Error deleting image');
        });
    }
}
