<?php

namespace App\Repositories;

use App\Models\Sentimental;
use FontLib\Table\Type\name;
use Illuminate\Support\Facades\DB;

class SentimentalRepository
{
    public function store(array $data)
    {
        DB::transaction(function () use ($data) {
            $created = Sentimental::create([
                'name' => data_get($data, 'name'),
            ]);

            throw_if(!$created, \Exception::class,  'Error creating sentimental');

            return $created;
        });
    }

    public function update(array $data, Sentimental $sentimental)
    {
        DB::transaction(function () use ($data, $sentimental) {
            $updated = $sentimental->update($data);
            throw_if(!$updated, \Exception::class,  'Error updating sentimental');
        });
        return $sentimental->refresh();
    }

    public function destroy(Sentimental $sentimental)
    {
        DB::transaction(function () use ($sentimental) {
            $deleted = $sentimental->delete();
            throw_if(!$deleted, \Exception::class,  'Error deleting sentimental');
        });
    }
}
