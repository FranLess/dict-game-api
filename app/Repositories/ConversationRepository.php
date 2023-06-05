<?php

namespace App\Repositories;

use App\Models\Conversation;
use Illuminate\Support\Facades\DB;

class ConversationRepository
{
    public function store(array $data)
    {
        DB::transaction(function () use ($data) {
            $created = Conversation::create([
                'sender_id' => data_get($data, 'sender_id'),
                'receptor_id' => data_get($data, 'receptor_id'),
            ]);

            throw_if(!$created, \Exception::class,  'Error creating conversation');

            return $created;
        });
    }

    public function update(array $data, Conversation $conversation)
    {
        DB::transaction(function () use ($data, $conversation) {
            $updated = $conversation->update($data);
            throw_if(!$updated, \Exception::class,  'Error updating conversation');
        });
        return $conversation->refresh();
    }

    public function destroy(Conversation $conversation)
    {
        DB::transaction(function () use ($conversation) {
            $deleted = $conversation->delete();
            throw_if(!$deleted, \Exception::class,  'Error deleting conversation');
        });
    }
}
