<?php

namespace Database\Factories;

use App\Models\Conversation;
use App\Models\User;
use Database\Factories\Helpers\FactoryHelper;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Message>
 */
class MessageFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $id = FactoryHelper::getRandomModelId(Conversation::class);
        $conversation = Conversation::find($id);
        return [
            'user_id' => fake()->randomElement([$conversation->sender_id, $conversation->receptor_id]),
            'conversation_id' => $conversation->id,
            'content' => fake()->sentence(),
            'is_read' => fake()->boolean(),
        ];
    }
}
