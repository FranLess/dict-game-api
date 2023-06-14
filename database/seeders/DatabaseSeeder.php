<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Models\Profile;
use Database\Seeders\Traits\DisableForeignKeys;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    use DisableForeignKeys;
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // \App\Models\User::factory(10)->create();

        // \App\Models\User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);

        $this->disableForeignKeys();

        $this->call([
            CountrySeeder::class,

            LevelSeeder::class,

            SentimentalSeeder::class,

            ReceptorTypeSeeder::class,

            // UserSeeder::class,

            // ProfileSeeder::class,

            // TeamSeeder::class,

            // PostSeeder::class,

            // HeartSeeder::class,

            // ImageSeeder::class,

            // CommentSeeder::class,

            // FriendSeeder::class,

            // ConversationSeeder::class,

            // MessageSeeder::class,
        ]);

        $this->enableForeignKeys();
    }
}
