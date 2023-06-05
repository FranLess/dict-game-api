<?php

namespace App\Repositories;

use App\Models\Level;
use Illuminate\Support\Facades\DB;

class LevelRepository
{
    public function store(array $data)
    {
        DB::transaction(function () use ($data) {
            $created = Level::create([
                'name' => data_get($data, 'name'),
            ]);

            throw_if(!$created, \Exception::class,  'Error creating level');

            return $created;
        });
    }

    public function update(array $data, Level $level)
    {
        DB::transaction(function () use ($data, $level) {
            $updated = $level->update($data);
            throw_if(!$updated, \Exception::class,  'Error updating level');
        });
        return $level->refresh();
    }

    public function destroy(Level $level)
    {
        DB::transaction(function () use ($level) {
            $deleted = $level->delete();
            throw_if(!$deleted, \Exception::class,  'Error deleting level');
        });
    }
}
