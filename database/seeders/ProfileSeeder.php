<?php

namespace Database\Seeders;

use App\Models\Profile;
use App\Models\User;
use Database\Seeders\Traits\TruncateTable;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ProfileSeeder extends Seeder
{
    use TruncateTable;
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $this->truncate('profiles');
        User::withCount('hearts')->select('id')->get()->each(function ($user) {
            Profile::factory()->create([
                'user_id' => $user->id,
                // 'likes' => $user->hearts_count,
                // 'dislikes' => $user->dislike_count,
            ]);
        });
    }
}
