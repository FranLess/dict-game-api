<?php

namespace App\Repositories;

use App\Models\ReceptorType;
use Illuminate\Support\Facades\DB;

class ReceptorTypeRepository
{
    public function store(array $data)
    {
        DB::transaction(function () use ($data) {
            $created = ReceptorType::create([
                'name' => data_get($data, 'name'),
            ]);

            throw_if(!$created, \Exception::class,  'Error creating receptorType');

            return $created;
        });
    }

    public function update(array $data, ReceptorType $receptorType)
    {
        DB::transaction(function () use ($data, $receptorType) {
            $updated = $receptorType->update($data);
            throw_if(!$updated, \Exception::class,  'Error updating receptorType');
        });
        return $receptorType->refresh();
    }

    public function destroy(ReceptorType $receptorType)
    {
        DB::transaction(function () use ($receptorType) {
            $deleted = $receptorType->delete();
            throw_if(!$deleted, \Exception::class,  'Error deleting receptorType');
        });
    }
}
