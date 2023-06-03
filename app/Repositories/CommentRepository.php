<?php

namespace App\Repositories;

use App\Models\Comment;
use Illuminate\Support\Facades\DB;

class CommentRepository
{
    public function store(array $data)
    {
        DB::transaction(function () use ($data) {
            $created = Comment::create([
                'content' => data_get($data, 'content'),
                'post_id' => data_get($data, 'post_id'),
                'user_id' => data_get($data, 'user_id'),
                'comment_id' => data_get($data, 'comment_id'),
            ]);

            throw_if(!$created, \Exception::class,  'Error creating comment');

            return $created;
        });
    }

    public function update(array $data, Comment $comment)
    {
        DB::transaction(function () use ($data, $comment) {
            $updated = $comment->update($data);
            throw_if(!$updated, \Exception::class,  'Error updating comment');
        });
        return $comment->refresh();
    }

    public function destroy(Comment $comment)
    {
        DB::transaction(function () use ($comment) {
            $deleted = $comment->delete();
            throw_if(!$deleted, \Exception::class,  'Error deleting comment');
        });
    }
}
