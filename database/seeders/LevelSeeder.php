<?php

namespace Database\Seeders;

use Database\Seeders\Traits\TruncateTable;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class LevelSeeder extends Seeder
{
    use TruncateTable;
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $this->truncate('levels');
        $levels = ['pivate', 'public'];
        foreach ($levels as $key => $level) {
            \App\Models\Level::create([
                'name' => $level,
            ]);
        }
    }
}
