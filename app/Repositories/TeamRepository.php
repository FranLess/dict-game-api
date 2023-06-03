<?php

namespace App\Repositories;

use App\Models\Team;
use Illuminate\Support\Facades\DB;

class TeamRepository
{
    public function store(array $data)
    {
        DB::transaction(function () use ($data) {
            $created = Team::create([
                'name' => data_get($data, 'name'),
                'slug' => data_get($data, 'slug'),
                'user_id' => data_get($data, 'user_id'),
                'description' => data_get($data, 'description'),
                'image' => data_get($data, 'image'),
            ]);

            throw_if(!$created, \Exception::class,  'Error creating team');

            return $created;
        });
    }

    public function update(array $data, Team $team)
    {
        DB::transaction(function () use ($data, $team) {
            $updated = $team->update($data);
            throw_if(!$updated, \Exception::class,  'Error updating team');
        });
        return $team->refresh();
    }

    public function destroy(Team $team)
    {
        DB::transaction(function () use ($team) {
            $deleted = $team->delete();
            throw_if(!$deleted, \Exception::class,  'Error deleting team');
        });
    }
}
