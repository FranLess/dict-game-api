<?php

namespace App\Repositories;

use App\Models\Heart;
use Illuminate\Support\Facades\DB;

class HeartRepository
{
    public function store(array $data)
    {
        DB::transaction(function () use ($data) {
            $created = Heart::create([
                'user_id' => data_get($data, 'user_id'),
                'post_id' => data_get($data, 'post_id'),
            ]);

            throw_if(!$created, \Exception::class,  'Error creating heart');

            return $created;
        });
    }

    public function update(array $data, Heart $heart)
    {
        DB::transaction(function () use ($data, $heart) {
            $updated = $heart->update($data);
            throw_if(!$updated, \Exception::class,  'Error updating heart');
        });
        return $heart->refresh();
    }

    public function destroy(Heart $heart)
    {
        DB::transaction(function () use ($heart) {
            $deleted = $heart->delete();
            throw_if(!$deleted, \Exception::class,  'Error deleting heart');
        });
    }
}
