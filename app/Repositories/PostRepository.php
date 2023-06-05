<?php

namespace App\Repositories;

use App\Models\Post;
use Illuminate\Support\Facades\DB;

class PostRepository
{
    public function store(array $data)
    {
        DB::transaction(function () use ($data) {
            $created = Post::create([
                'title' => data_get($data, 'title'),
                'content' => data_get($data, 'content'),
                'user_id' => data_get($data, 'user_id'),
                'level_id' => data_get($data, 'level_id'),
                'receptor_type_id' => data_get($data, 'receptor_type_id'),
                'team_id' => data_get($data, 'team_id'),
            ]);

            throw_if(!$created, \Exception::class,  'Error creating post');

            return $created;
        });
    }

    public function update(array $data, Post $post)
    {
        DB::transaction(function () use ($data, $post) {
            $updated = $post->update($data);
            throw_if(!$updated, \Exception::class,  'Error updating post');
        });
        return $post->refresh();
    }

    public function destroy(Post $post)
    {
        DB::transaction(function () use ($post) {
            $deleted = $post->delete();
            throw_if(!$deleted, \Exception::class,  'Error deleting post');
        });
    }
}
