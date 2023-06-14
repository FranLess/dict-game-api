<?php

namespace Database\Seeders;

use App\Models\Image;
use Database\Seeders\Traits\TruncateTable;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ImageSeeder extends Seeder
{
    use TruncateTable;
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $this->truncate('images');
        foreach (range(1, 50) as $i) {
            $image = Image::factory()->create();
            $image->posts()->attach($image->id);
        }
    }
}
