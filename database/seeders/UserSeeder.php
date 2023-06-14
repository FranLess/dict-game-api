<?php

namespace Database\Seeders;

use App\Models\Profile;
use App\Models\User;
use Database\Seeders\Traits\TruncateTable;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    use TruncateTable;
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $this->truncate('users');
        User::factory(100)->create();
    }
}
