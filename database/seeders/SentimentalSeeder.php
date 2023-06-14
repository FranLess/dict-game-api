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
        $emotions = [
            'Feliz',
            'Triste',
            'Enojado',
            'Asustado',
            'Emocionado',
            'Cansado',
            'Alegre',
            'Nervioso',
            'Sorprendido',
            'Amoroso',
        ];

        foreach ($emotions as $emotion) {
            Sentimental::factory()->create([
                'name' => $emotion,
            ]);
        }
    }
}
