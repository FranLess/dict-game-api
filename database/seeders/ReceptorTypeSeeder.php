<?php

namespace Database\Seeders;

use App\Models\ReceptorType;
use Database\Seeders\Traits\TruncateTable;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ReceptorTypeSeeder extends Seeder
{
    use TruncateTable;
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $this->truncate('receptor_types');
        $types = ['public', 'team'];
        foreach ($types as $type) {
            ReceptorType::create(['name' => $type]);
        }
    }
}
