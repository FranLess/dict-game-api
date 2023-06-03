<?php

namespace App\Repositories;

use App\Models\Image;
use Illuminate\Support\Facades\DB;

class ImageRepository
{
    public function store(array $data)
    {
        $image = $data['source'];
        // dd($image);
        DB::transaction(function () use ($data) {
            $created = Image::create([
                'source' => data_get($data, 'source'),
                'name' => data_get($data, 'name'),
                'user_id' => data_get($data, 'user_id'),
                'level_id' => data_get($data, 'level_id'),
            ]);

            throw_if(!$created, \Exception::class,  'Error creating image');

            return $created;
        });
    }

    public function update(array $data, Image $image)
    {
        DB::transaction(function () use ($data, $image) {
            $updated = $image->update($data);
            throw_if(!$updated, \Exception::class,  'Error updating image');
        });
        return $image->refresh();
    }

    public function destroy(Image $image)
    {
        DB::transaction(function () use ($image) {
            $deleted = $image->delete();
            throw_if(!$deleted, \Exception::class,  'Error deleting image');
        });
    }
}
