<?php

namespace App\Repositories;

use App\Models\Message;
use Illuminate\Support\Facades\DB;

class MessageRepository
{
    public function store(array $data)
    {
        DB::transaction(function () use ($data) {
            $created = Message::create([
                'user_id' => data_get($data, 'user_id'),
                'conversation_id' => data_get($data, 'conversation_id'),
                'content' => data_get($data, 'content'),
                'is_read' => data_get($data, 'is_read', false),
            ]);

            throw_if(!$created, \Exception::class,  'Error creating message');

            return $created;
        });
    }

    public function update(array $data, Message $message)
    {
        DB::transaction(function () use ($data, $message) {
            $updated = $message->update($data);
            throw_if(!$updated, \Exception::class,  'Error updating message');
        });
        return $message->refresh();
    }

    public function destroy(Message $message)
    {
        DB::transaction(function () use ($message) {
            $deleted = $message->delete();
            throw_if(!$deleted, \Exception::class,  'Error deleting message');
        });
    }
}
