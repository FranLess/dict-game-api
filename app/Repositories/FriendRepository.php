<?php

namespace App\Repositories;

use App\Models\Friend;
use Illuminate\Support\Facades\DB;

class FriendRepository
{
    public function store(array $data)
    {
        DB::transaction(function () use ($data) {
            $created = Friend::create([
                'sender_id' => data_get($data, 'sender_id'),
                'receptor_id' => data_get($data, 'receptor_id'),
            ]);

            throw_if(!$created, \Exception::class,  'Error creating friend');

            return $created;
        });
    }

    public function update(array $data, Friend $friend)
    {
        DB::transaction(function () use ($data, $friend) {
            $updated = $friend->update($data);
            throw_if(!$updated, \Exception::class,  'Error updating friend');
        });
        return $friend->refresh();
    }

    public function destroy(Friend $friend)
    {
        DB::transaction(function () use ($friend) {
            $deleted = $friend->delete();
            throw_if(!$deleted, \Exception::class,  'Error deleting friend');
        });
    }
}
