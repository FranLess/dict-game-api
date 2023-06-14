<?php

namespace Database\Factories;

use App\Models\Heart;
use App\Models\Post;
use App\Models\User;
use Database\Factories\Helpers\FactoryHelper;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Heart>
 */
class HeartFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        do {
            $user_id = FactoryHelper::getRandomModelId(User::class);
            $post_id = FactoryHelper::getRandomModelId(Post::class);
        } while (!Heart::where('user_id', $user_id)->where('post_id', $post_id)->exists());

        return [
            'post_id' => $post_id,
            'user_id' => $user_id,
        ];
    }
}
