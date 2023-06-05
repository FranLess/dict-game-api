<?php

namespace Database\Factories;

use App\Models\Comment;
use App\Models\Post;
use App\Models\User;
use Database\Factories\Helpers\FactoryHelper;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Comment>
 */
class CommentFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        // $comment_id = FactoryHelper::getRandomModelId(Comment::class);
        return [
            'post_id' => FactoryHelper::getRandomModelId(Post::class),
            'user_id' => FactoryHelper::getRandomModelId(User::class),
            'comment_id' => null,
            'content' => fake()->sentence(),

            // 'post_id' => 1,
            // 'user_id' => 2,
            // 'comment_id' => null,
            // 'content' => fake()->sentence(),
        ];
    }
}
