<?php

namespace Database\Seeders;

use App\Models\Sentimental;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class SentimentalSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Sentimental::factory(10)->create(); // (10
    }
}
